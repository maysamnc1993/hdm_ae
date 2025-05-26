/**
 * Flexible Dropdown Filter Component
 * @description Handles custom dropdown filtering with accessibility and flexibility
 * @version 2.0.0
 */
class DropdownFilter {
  /**
   * Create a new Dropdown Filter
   * @param {Object} options - Configuration options for the dropdown
   * @param {string|HTMLElement} options.container - Selector or element for the dropdown
   * @param {Function} [options.onSelect] - Callback function when an option is selected
   * @param {Object} [options.selectors] - Custom CSS selectors
   * @param {Object} [options.classes] - Custom CSS classes
   */
  constructor(options = {}) {
    // Merge default configuration with user options
    this.config = {
      selectors: {
        container:
          options.container instanceof HTMLElement
            ? options.container
            : document.querySelector(
                options.container || "#faq-category-dropdown"
              ),
        selectedOption: options.selectors?.selectedOption || ".selected-option",
        selectedOptionText:
          options.selectors?.selectedOptionText || ".selected-option span",
        dropdownOptions:
          options.selectors?.dropdownOptions || ".dropdown-options",
        option: options.selectors?.option || ".option",
        filterToggle: options.selectors?.filterToggle || ".faq-filter-toggle",
      },
      classes: {
        active: options.classes?.active || "active",
        selected: options.classes?.selected || "selected",
      },
      onSelect: options.onSelect || this.defaultSelectHandler,
    };

    // Validate container
    if (!this.config.selectors.container) {
      console.error("DropdownFilter: No container found");
      return;
    }

    // Find elements
    this.dropdown = this.config.selectors.container;
    this.selectedOptionEl = this.dropdown.querySelector(
      this.config.selectors.selectedOption
    );
    this.selectedOptionText = this.dropdown.querySelector(
      this.config.selectors.selectedOptionText
    );
    this.optionsContainer = this.dropdown.querySelector(
      this.config.selectors.dropdownOptions
    );
    this.options = this.dropdown.querySelectorAll(this.config.selectors.option);
    this.filterToggles = document.querySelectorAll(
      this.config.selectors.filterToggle
    );

    // Initialize the component
    this.init();
  }

  /**
   * Default select handler for filtering FAQ items
   * @param {string} value - Selected category value
   */
  defaultSelectHandler(value) {
    // Default implementation for filtering FAQ items
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
      const itemCategories = item.dataset.categories
        ? item.dataset.categories.split(" ")
        : [];

      if (value === "" || itemCategories.includes(value)) {
        item.style.display = "block";
      } else {
        item.style.display = "none";
      }
    });

    // Reset any open FAQ items if needed
    this.resetOpenFAQs();
  }

  /**
   * Reset open FAQ items when filtering
   */
  resetOpenFAQs() {
    const openQuestions = document.querySelectorAll(
      '.faq-question[aria-expanded="true"]'
    );

    openQuestions.forEach((question) => {
      const content = question.nextElementSibling;

      if (content) {
        question.setAttribute("aria-expanded", "false");
        content.classList.add("hidden");
        content.style.maxHeight = "0";

        const icon = question.querySelector(".faq-icon");
        if (icon) {
          icon.innerHTML = this.getOpenIcon();
        }
      }
    });
  }

  /**
   * Get default open icon SVG
   * @returns {string} SVG for open state
   */
  getOpenIcon() {
    return `
        <svg class="icon icon-arrow-down" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m6 9 6 6 6-6"/>
        </svg>
      `;
  }

  /**
   * Initialize the Dropdown Filter
   */
  init() {
    // Validate required elements
    if (
      !this.selectedOptionEl ||
      !this.optionsContainer ||
      this.options.length === 0
    ) {
      console.warn("DropdownFilter: Missing required elements");
      return;
    }

    // Toggle dropdown on selected option click
    this.selectedOptionEl.addEventListener("click", () =>
      this.toggleDropdown()
    );

    // Attach toggle event to filter toggle buttons
    if (this.filterToggles.length > 0) {
      this.filterToggles.forEach((toggle) => {
        toggle.addEventListener("click", () => this.toggleDropdown());
      });
    }

    // Handle option selection
    this.options.forEach((option) => {
      option.addEventListener("click", (event) =>
        this.selectOption(event.target)
      );
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) =>
      this.handleOutsideClick(event)
    );
  }

  /**
   * Toggle dropdown visibility
   */
  toggleDropdown() {
    this.dropdown.classList.toggle(this.config.classes.active);
  }

  /**
   * Select a dropdown option
   * @param {HTMLElement} option - Selected option element
   */
  selectOption(option) {
    const value = option.getAttribute("data-value");

    // Update selected option text
    if (this.selectedOptionText) {
      this.selectedOptionText.textContent = option.textContent;
    }

    // Remove selected class from all options
    this.options.forEach((opt) =>
      opt.classList.remove(this.config.classes.selected)
    );

    // Add selected class to current option
    option.classList.add(this.config.classes.selected);

    // Close dropdown
    this.dropdown.classList.remove(this.config.classes.active);

    // Call select handler
    this.config.onSelect(value);
  }

  /**
   * Handle clicks outside the dropdown
   * @param {Event} event - Click event
   */
  handleOutsideClick(event) {
    const isDropdownClick = this.dropdown.contains(event.target);
    const isFilterToggleClick = Array.from(this.filterToggles).some((toggle) =>
      toggle.contains(event.target)
    );

    if (!isDropdownClick && !isFilterToggleClick) {
      this.dropdown.classList.remove(this.config.classes.active);
    }
  }

  /**
   * Destroy the Dropdown Filter and remove event listeners
   */
  destroy() {
    // Remove event listeners
    this.selectedOptionEl.removeEventListener("click", () =>
      this.toggleDropdown()
    );

    this.filterToggles.forEach((toggle) => {
      toggle.removeEventListener("click", () => this.toggleDropdown());
    });

    this.options.forEach((option) => {
      option.removeEventListener("click", (event) =>
        this.selectOption(event.target)
      );
    });

    document.removeEventListener("click", (event) =>
      this.handleOutsideClick(event)
    );
  }
}

// Expose DropdownFilter globally
window.DropdownFilter = DropdownFilter;

// Helper function to initialize dropdown filters
function initializeDropdownFilters(
  selector = "#faq-category-dropdown",
  options = {}
) {
  const dropdownContainers = document.querySelectorAll(selector);

  dropdownContainers.forEach((container) => {
    new DropdownFilter({
      container: container,
      ...options,
    });
  });
}

// Optional: Auto-initialize if desired
document.addEventListener("DOMContentLoaded", () => {
  initializeDropdownFilters();
});

export { DropdownFilter, initializeDropdownFilters };
