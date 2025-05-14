/**
 * Enhanced FAQ Component with Category Filtering
 * @description Handles expandable/collapsible FAQ sections with category filtering
 * @version 3.0.0
 */
class FAQComponent {
  constructor(options = {}) {
    this.config = {
      selectors: {
        container:
          options.container instanceof HTMLElement
            ? options.container
            : document.querySelector(
                options.container || "#faq_home_container"
              ),
        items: options.selectors?.items || ".faq-items",
        item: options.selectors?.item || ".faq-item",
        question: options.selectors?.question || ".faq-question",
        icon: options.selectors?.icon || ".faq-icon",
        content: options.selectors?.content || ".faq-answer",
      },
      classes: {
        hidden: options.classes?.hidden || "hidden",
        active: options.classes?.active || "active",
        expanded: options.classes?.expanded || "expanded",
      },
      attributes: {
        expanded: options.attributes?.expanded || "aria-expanded",
        controls: options.attributes?.controls || "aria-controls",
        categories: options.attributes?.categories || "data-categories",
      },
      allowMultiple: options.allowMultiple ?? false,
      animationDuration: options.animationDuration || 300,
      icons: {
        open: options.icons?.open || this.defaultOpenIcon(),
        close: options.icons?.close || this.defaultCloseIcon(),
      },
    };

    if (!this.config.selectors.container) {
      console.error("FAQComponent: No container found");
      return;
    }

    this.container = this.config.selectors.container;
    this.init();
  }

  defaultOpenIcon() {
    // return `
    //   <svg class="icon icon-arrow-square-down" aria-hidden="true"><use href="${window.location.origin}/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-down"></use></svg>
    // `;
    return `
      <svg class="icon icon-arrow-square-down" aria-hidden="true"><use href="https://staging.hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-down"></use></svg>
    `;
  }

  defaultCloseIcon() {
    // return `
    //  <svg class="icon icon-arrow-square-up" aria-hidden="true"><use href="${window.location.origin}/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-up"></use></svg>
    // `;
    return `
     <svg class="icon icon-arrow-square-up" aria-hidden="true"><use href="https://staging.hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-up"></use></svg>
    `;
  }

  init() {
    this.container.addEventListener("click", (event) => {
      const question = event.target.closest(this.config.selectors.question);
      if (question) {
        this.toggleQuestion(question);
      }
    });
  }

  toggleQuestion(question) {
    const isExpanded =
      question.getAttribute(this.config.attributes.expanded) === "true";
    const content = this.findContent(question);

    if (!content) {
      console.warn("FAQComponent: No content found for question", question);
      return;
    }

    question.setAttribute(this.config.attributes.expanded, !isExpanded);

    if (isExpanded) {
      this.closeItem(question, content);
    } else {
      this.openItem(question, content);
      if (!this.config.allowMultiple) {
        this.closeOtherItems(question);
      }
    }
  }

  findContent(question) {
    const contentId = question.getAttribute(this.config.attributes.controls);
    return contentId
      ? document.getElementById(contentId)
      : question.nextElementSibling.querySelector(
          this.config.selectors.content
        );
  }

  openItem(question, content) {
    content.classList.remove(this.config.classes.hidden);
    content.style.maxHeight = `${content.scrollHeight}px`;

    const icon = question.querySelector(this.config.selectors.icon);
    if (icon) {
      icon.innerHTML = this.config.icons.close;
    }
  }

  closeItem(question, content) {
    content.style.maxHeight = "0";

    const icon = question.querySelector(this.config.selectors.icon);
    if (icon) {
      icon.innerHTML = this.config.icons.open;
    }

    setTimeout(() => {
      content.classList.add(this.config.classes.hidden);
    }, this.config.animationDuration);
  }

  closeOtherItems(currentQuestion) {
    const allQuestions = this.container.querySelectorAll(
      this.config.selectors.question
    );
    allQuestions.forEach((question) => {
      if (
        question !== currentQuestion &&
        question.getAttribute(this.config.attributes.expanded) === "true"
      ) {
        question.setAttribute(this.config.attributes.expanded, "false");
        const content = this.findContent(question);
        if (content) {
          this.closeItem(question, content);
        }
      }
    });
  }

  filterByCategory(category) {
    const faqItems = this.container.querySelectorAll(
      this.config.selectors.item
    );
    faqItems.forEach((item) => {
      const itemCategories = item.getAttribute(
        this.config.attributes.categories
      );

      const isVisible =
        category === "" ||
        (itemCategories && itemCategories.split(" ").includes(category));

      item.style.display = isVisible ? "block" : "none";

      const question = item.querySelector(this.config.selectors.question);
      const content = item.querySelector(this.config.selectors.content);

      if (question && content) {
        question.setAttribute(this.config.attributes.expanded, "false");
        this.closeItem(question, content);
      }
    });
  }

  destroy() {
    this.container.removeEventListener("click", (event) => {
      const question = event.target.closest(this.config.selectors.question);
      if (question) {
        this.toggleQuestion(question);
      }
    });
  }
}

/**
 * Enhanced Dropdown Filter for FAQ Categories
 */
class FAQDropdownFilter {
  /**
   * Create a new Dropdown Filter for FAQ Categories
   * @param {Object} options - Configuration options for the dropdown
   * @param {FAQComponent} options.faqComponent - FAQComponent instance to filter
   */
  constructor(options = {}) {
    // Configuration
    this.config = {
      selectors: {
        container: options.container || "#faq-category-dropdown",
        selectedOption: ".selected-option",
        selectedOptionText: ".selected-option span",
        dropdownOptions: ".dropdown-options",
        option: ".option",
        filterToggle: ".faq-filter-toggle",
      },
      classes: {
        active: "active",
        selected: "selected",
      },
    };

    // Find dropdown elements
    this.dropdown = document.querySelector(this.config.selectors.container);
    this.selectedOptionText = this.dropdown.querySelector(
      this.config.selectors.selectedOptionText
    );
    this.options = this.dropdown.querySelectorAll(this.config.selectors.option);
    this.filterToggles = document.querySelectorAll(
      this.config.selectors.filterToggle
    );

    // FAQ Component for filtering
    this.faqComponent =
      options.faqComponent ||
      new FAQComponent({ container: "#faq_home_container" });

    // Initialize
    this.init();
  }

  /**
   * Initialize the dropdown filter
   */
  init() {
    // Validate required elements
    if (
      !this.dropdown ||
      !this.selectedOptionText ||
      this.options.length === 0
    ) {
      console.warn("FAQDropdownFilter: Missing required elements");
      return;
    }

    // Toggle dropdown on selected option click
    const selectedOptionEl = this.dropdown.querySelector(
      this.config.selectors.selectedOption
    );
    selectedOptionEl.addEventListener("click", () => this.toggleDropdown());

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
    this.selectedOptionText.textContent = option.textContent;

    // Remove selected class from all options
    this.options.forEach((opt) =>
      opt.classList.remove(this.config.classes.selected)
    );

    // Add selected class to current option
    option.classList.add(this.config.classes.selected);

    // Close dropdown
    this.dropdown.classList.remove(this.config.classes.active);

    // Filter FAQ items
    this.faqComponent.filterByCategory(value);
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
}

// Expose components globally
window.FAQComponent = FAQComponent;
window.FAQDropdownFilter = FAQDropdownFilter;

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  const faqContainer = document.querySelector("#faq_home_container");
  if (faqContainer) {
    const faqComponent = new FAQComponent({ container: faqContainer });
    new FAQDropdownFilter({ faqComponent });
  }
});

export { FAQComponent, FAQDropdownFilter };

// // Automatic initialization (recommended)
// document.addEventListener('DOMContentLoaded', () => {
//   const faqContainer = document.querySelector('#faq_home_container');
//   if (faqContainer) {
//     const faqComponent = new FAQComponent({ container: faqContainer });
//     new FAQDropdownFilter({ faqComponent });
//   }
// });

// // Manual initialization
// const faqComponent = new FAQComponent({
//   container: '#faq_home_container',
//   allowMultiple: false
// });

// const dropdownFilter = new FAQDropdownFilter({
//   faqComponent: faqComponent
// });
