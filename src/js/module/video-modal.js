/**
 * VideoModal - A reusable video modal component
 * @description Creates a modal for playing videos when triggered by click events
 */
class VideoModal {
  /**
   * Create a video modal instance
   * @param {Object} options - Configuration options
   * @param {string} options.modalClass - CSS class for the modal container
   * @param {string} options.closeClass - CSS class for the close button
   * @param {string} options.videoClass - CSS class for the video element
   * @param {string} options.overlayClass - CSS class for the overlay
   * @param {string} options.activeClass - CSS class added when modal is active
   * @param {string} options.videoSrc - URL to the video file (optional, can be set later)
   * @param {string} options.triggerSelector - CSS selector for click triggers
   */
  constructor(options = {}) {
    // Default options
    this.options = Object.assign(
      {
        modalClass: "video-modal",
        closeClass: "video-modal__close",
        videoClass: "video-modal__video",
        overlayClass: "video-modal__overlay",
        activeClass: "is-active",
        videoSrc: "",
        triggerSelector: ".about-video-container",
      },
      options
    );

    this.isInitialized = false;
    this.videoElement = null;
    this.modalElement = null;

    // Initialize the modal
    this.init();
  }

  /**
   * Initialize the modal and event listeners
   */
  init() {
    if (this.isInitialized) return;

    // Create modal elements
    this.createModalElements();

    // Add event listeners
    this.addEventListeners();

    this.isInitialized = true;
  }

  /**
   * Create modal DOM elements and add to document
   */
  createModalElements() {
    // Create modal container
    this.modalElement = document.createElement("div");
    this.modalElement.className = this.options.modalClass;

    // Create overlay
    const overlay = document.createElement("div");
    overlay.className = this.options.overlayClass;

    // Create close button
    const closeBtn = document.createElement("button");
    closeBtn.className = this.options.closeClass;
    closeBtn.innerHTML = "&times;";
    closeBtn.setAttribute("aria-label", "Close video");

    // Create video element
    this.videoElement = document.createElement("video");
    this.videoElement.className = this.options.videoClass;
    this.videoElement.controls = true;
    this.videoElement.preload = "metadata";

    // Assemble modal
    this.modalElement.appendChild(overlay);
    this.modalElement.appendChild(closeBtn);
    this.modalElement.appendChild(this.videoElement);

    // Add modal to document
    document.body.appendChild(this.modalElement);
  }

  /**
   * Add event listeners to modal elements and triggers
   */
  addEventListeners() {
    // Get all trigger elements
    const triggerElements = document.querySelectorAll(
      this.options.triggerSelector
    );

    // Add click event to each trigger
    triggerElements.forEach((trigger) => {
      trigger.addEventListener("click", (e) => {
        e.preventDefault();
        console.log(trigger);
        // Get video src from data attribute or use default
        const videoSrc = trigger.dataset.videoSrc || this.options.videoSrc;

        if (videoSrc) {
          this.openWithVideo(videoSrc);
        } else {
          console.warn("No video source provided");
        }
      });
    });

    // Close modal when clicking close button
    const closeBtn = this.modalElement.querySelector(
      `.${this.options.closeClass}`
    );
    closeBtn.addEventListener("click", () => this.close());

    // Close modal when clicking overlay
    const overlay = this.modalElement.querySelector(
      `.${this.options.overlayClass}`
    );
    overlay.addEventListener("click", () => this.close());

    // Close modal on escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && this.isOpen()) {
        this.close();
      }
    });
  }

  /**
   * Open the modal with a specific video
   * @param {string} videoSrc - URL to the video file
   */
  openWithVideo(videoSrc) {
    // Set video source
    this.videoElement.src = videoSrc;

    // Open modal
    this.open();

    // Auto play video
    this.videoElement.play().catch((error) => {
      console.warn("Auto-play was prevented:", error);
    });
  }

  /**
   * Open the modal
   */
  open() {
    this.modalElement.classList.add(this.options.activeClass);
    document.body.style.overflow = "hidden"; // Prevent scrolling
  }

  /**
   * Close the modal
   */
  close() {
    // Pause and reset video
    this.videoElement.pause();
    this.videoElement.currentTime = 0;

    // Close modal
    this.modalElement.classList.remove(this.options.activeClass);
    document.body.style.overflow = ""; // Restore scrolling
  }

  /**
   * Check if modal is currently open
   * @return {boolean} True if modal is open
   */
  isOpen() {
    return this.modalElement.classList.contains(this.options.activeClass);
  }
}

export default VideoModal;