export default class VideoPlayer {
    constructor(containerSelector) {
        this.$containers = jQuery(containerSelector);
        
        if (!this.$containers.length) {
            console.warn(`VideoPlayer: No containers found for selector: ${containerSelector}`);
            return;
        }

        this.players = [];
        this.init();
    }

    init() {
        this.$containers.each((index, container) => {
            const $container = jQuery(container);
            const $video = $container.find('.video-element');
            const $overlay = $container.find('.video-overlay');
            const $trigger = $container.find('.video-trigger');

            if (!$video.length || !$overlay.length || !$trigger.length) {
                console.warn('VideoPlayer: Required elements not found in container:', {
                    container,
                    video: $video.length,
                    overlay: $overlay.length,
                    trigger: $trigger.length
                });
                return;
            }

            const player = {
                $video,
                $overlay,
                $trigger
            };

            this.players.push(player);

            // Bind click event to the trigger
            $container.on('click', this.playVideo.bind(this, player));

            // Video state event listeners
            $video.on('play', this.onVideoPlay.bind(this, player));
            $video.on('pause', this.onVideoPause.bind(this, player));
            $video.on('ended', this.onVideoEnd.bind(this, player));
        });
    }

    playVideo(player, event) {
        event.preventDefault();
        if (player.$video[0] && typeof player.$video[0].play === 'function') {
            player.$video[0].play().catch(error => {
                console.error('VideoPlayer: Error playing video:', error);
            });
        } else {
            console.error('VideoPlayer: Invalid video element or play function missing');
        }
    }

    onVideoPlay(player) {
        player.$overlay.css('display', 'none');
        player.$video[0].setAttribute('controls', '');
    }

    onVideoPause(player) {
        player.$overlay.css('display', 'flex');
    }

    onVideoEnd(player) {
        player.$overlay.css('display', 'flex');
        player.$video[0].removeAttribute('controls');
    }
}