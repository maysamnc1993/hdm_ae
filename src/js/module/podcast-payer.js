const $ = window.jQuery;
export default class PodcastPlayer {
    
  constructor(element, WaveSurfer) {
    this.element = $(element);
    this.podcastId = this.element.attr("id");
    this.audioUrl = this.element.data("audio-url");
    this.audioElement = this.element.find(".podcast-audio")[0];
    this.waveSurfer = null;
    this.isPlaying = false;

    if (WaveSurfer) {
      this.initializeWaveSurfer(WaveSurfer);
    } else {
      this.initializeFallbackWaveform();
    }

    this.setupEventListeners();
  }

  initializeWaveSurfer(WaveSurfer) {
    const container = this.element.find(".waveform-container")[0];
    if (container) {
      this.waveSurfer = WaveSurfer.create({
        container: container,
        waveColor: "#1f2937",
        progressColor: "#ef4444",
        cursorColor: "transparent",
        barWidth: 2,
        barGap: 1,
        barRadius: 0,
        height: 40,
        responsive: true,
        normalize: true,
      });
      this.waveSurfer.load(this.audioUrl);
      this.waveSurfer.on("ready", () => {
        const duration = this.formatPersianTime(
          Math.floor(this.waveSurfer.getDuration())
        );
        console.log(duration)
        this.element.find(".duration").text(duration);
      });
      this.waveSurfer.on("audioprocess", () => {
        this.updateTime();
      });
    }
  }

  initializeFallbackWaveform() {
    const container = this.element.find(".waveform-container");
    if (container.length) {
      container.html(this.createFallbackWaveform());
      container.on("click", (e) => {
        const rect = container[0].getBoundingClientRect();
        const position = (e.clientX - rect.left) / rect.width;
        this.seekTo(position);
      });
    }
  }

  createFallbackWaveform() {
    const barsCount = 50;
    const heights = this.generateRandomHeights(barsCount);
    const arrangedHeights = this.arrangeHeights(barsCount, heights);
    let html =
      '<div class="relative h-10 w-full flex items-center justify-center">';
    html +=
      '<div class="progress-bar absolute left-0 top-0 bottom-0 bg-red-500 bg-opacity-30 w-0"></div>';
    html +=
      '<div class="bars-container relative flex flex-row-reverse items-center justify-between w-full h-full">';
    for (let i = 0; i < barsCount; i++) {
      html += `<div class="bar w-0.5 bg-gray-700" style="height: ${arrangedHeights[i]}px;"></div>`;
    }
    html += "</div></div>";
    return html;
  }

  generateRandomHeights(barsCount) {
    const heights = [];
    for (let i = 0; i < barsCount; i++) {
      heights.push(Math.floor(Math.random() * 30) + 5);
    }
    return heights;
  }

  arrangeHeights(barsCount, heights) {
    const middleIndex = Math.floor(barsCount / 2);
    const arrangedHeights = new Array(barsCount);
    for (let i = 0; i < barsCount; i++) {
      const distanceFromMiddle = Math.abs(i - middleIndex);
      const heightIndex = Math.floor(
        (distanceFromMiddle / middleIndex) * heights.length
      );
      arrangedHeights[i] = heights[Math.min(heightIndex, heights.length - 1)];
    }
    return arrangedHeights;
  }

  setupEventListeners() {
    this.element.find(".play-pause-btn").on("click", () => {
      this.togglePlayPause();
    });

    $(this.audioElement).on("timeupdate", () => {
      this.updateTime();
      if (!this.waveSurfer) {
        this.updateFallbackWaveform();
      }
    });

    $(this.audioElement).on("loadedmetadata", () => {
      const duration = this.formatPersianTime(
        Math.floor(this.audioElement.duration)
      );
      this.element.find(".duration").text(duration);
    });

    $(this.audioElement).on("ended", () => {
      this.resetPlayerUI();
    });
  }

  togglePlayPause() {
    if (this.isPlaying) {
      this.pause();
    } else {
      this.play();
    }
  }

  play() {
    PodcastPlayer.stopAllPlayers();
    this.audioElement.play();
    if (this.waveSurfer) {
      this.waveSurfer.play();
    }
    this.isPlaying = true;
    this.updatePlayPauseIcons();
  }

  pause() {
    this.audioElement.pause();
    if (this.waveSurfer) {
      this.waveSurfer.pause();
    }
    this.isPlaying = false;
    this.updatePlayPauseIcons();
  }

  seekTo(position) {
    const newTime = this.audioElement.duration * position;
    this.audioElement.currentTime = newTime;
    if (this.waveSurfer) {
      this.waveSurfer.seekTo(position);
    }
    if (!this.isPlaying) {
      this.play();
    }
  }

  updateTime() {
    const currentTime = this.formatPersianTime(
      Math.floor(this.audioElement.currentTime)
    );
    this.element.find(".current-time").text(currentTime);
  }

  updateFallbackWaveform() {
    const container = this.element.find(".waveform-container");
    const progressBar = container.find(".progress-bar");
    const percentage =
      this.audioElement.currentTime / this.audioElement.duration;
    progressBar.css("width", percentage * 100 + "%");
    const bars = container.find(".bar");
    const activeBarCount = Math.floor(bars.length * percentage);
    bars.each((index, bar) => {
      if (index < activeBarCount) {
        $(bar).removeClass("bg-gray-700").addClass("bg-red-500");
      } else {
        $(bar).removeClass("bg-red-500").addClass("bg-gray-700");
      }
    });
  }

  resetPlayerUI() {
    this.isPlaying = false;
    this.updatePlayPauseIcons();
    if (!this.waveSurfer) {
      const container = this.element.find(".waveform-container");
      container.find(".progress-bar").css("width", "0%");
      container.find(".bar").removeClass("bg-red-500").addClass("bg-gray-700");
    }
  }

  updatePlayPauseIcons() {
    const playIcon = this.element.find(".play-icon");
    const pauseIcon = this.element.find(".pause-icon");
    if (this.isPlaying) {
      playIcon.addClass("!hidden");
      pauseIcon.removeClass("!hidden");
    } else {
      playIcon.removeClass("!hidden");
      pauseIcon.addClass("!hidden");
    }
  }

  formatPersianTime(timeInSeconds) {
    const hours = Math.floor(timeInSeconds / 3600);
    const minutes = Math.floor((timeInSeconds % 3600) / 60);
    const seconds = Math.floor(timeInSeconds % 60);
    let formattedTime = "";
    if (hours > 0) {
      formattedTime =
        this.toPersianNum(hours.toString().padStart(2, "0")) + ":";
    }
    formattedTime +=
      this.toPersianNum(minutes.toString().padStart(2, "0")) + ":";
    formattedTime += this.toPersianNum(seconds.toString().padStart(2, "0"));
    return formattedTime;
  }

  toPersianNum(num) {
    const persianDigits = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
    return String(num).replace(/[0-9]/g, (w) => persianDigits[+w]);
  }

  static stopAllPlayers() {
    PodcastPlayer.players.forEach((player) => {
      if (player.isPlaying) {
        player.pause();
      }
    });
  }
}
