/**
 * Standalone FAQ Component JavaScript
 * For direct inclusion in the page
 */

(function() {
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFAQs);
    } else {
        initFAQs();
    }

    function initFAQs() {
        console.log('Initializing FAQ components');
        
        // Find all FAQ containers but exclude item and content IDs
        const faqContainers = document.querySelectorAll('[id^="faq_"]:not([id*="_item_"]):not([id*="_content"])');
        
        if (faqContainers.length === 0) {
            console.log('No FAQ containers found on the page');
            return;
        }
        
        console.log(`Found ${faqContainers.length} FAQ containers`);
        
        // Initialize each container
        faqContainers.forEach(function(container) {
            new FAQComponent(container);
        });
    }

    // FAQ Component Class
    function FAQComponent(container) {
        this.container = container;
        this.itemsContainer = this.container.querySelector('.faq-items');
        this.questions = this.container.querySelectorAll('.faq-question');
        this.allowMultiple = this.itemsContainer ? 
            this.itemsContainer.getAttribute('data-allow-multiple') === 'true' : false;
        
        this.init();
    }
    
    // Initialize component
    FAQComponent.prototype.init = function() {
        if (!this.questions || this.questions.length === 0) {
            console.warn('No FAQ questions found in container', this.container.id);
            return;
        }
        
        console.log(`Adding event listeners to ${this.questions.length} questions in ${this.container.id}`);
        
        // Add click handlers to questions
        var self = this;
        this.questions.forEach(function(question) {
            question.addEventListener('click', function() {
                self.toggleQuestion(this);
            });
        });
    };
    
    // Toggle question open/closed
    FAQComponent.prototype.toggleQuestion = function(question) {
        var isExpanded = question.getAttribute('aria-expanded') === 'true';
        var content = question.nextElementSibling;
        
        if (!content) return;
        
        // Toggle current item
        question.setAttribute('aria-expanded', !isExpanded);
        
        if (isExpanded) {
            this.closeItem(question, content);
        } else {
            this.openItem(question, content);
            
            // If not allowing multiple open items, close others
            if (!this.allowMultiple) {
                this.closeOtherItems(question);
            }
        }
    };
    
    // Open an item
    FAQComponent.prototype.openItem = function(question, content) {
        content.classList.remove('hidden');
        
        // Force browser to recognize the change before setting maxHeight
        content.offsetHeight;
        
        content.style.maxHeight = content.scrollHeight + 'px';
        
        // Update icon
        var icon = question.querySelector('.faq-icon');
        if (icon) {
            icon.innerHTML = this.getCloseIcon();
        }
    };
    
    // Close an item
    FAQComponent.prototype.closeItem = function(question, content) {
        content.style.maxHeight = '0';
        
        var icon = question.querySelector('.faq-icon');
        if (icon) {
            icon.innerHTML = this.getOpenIcon();
        }
        
        // Add hidden class after animation completes
        setTimeout(function() {
            content.classList.add('hidden');
        }, 300);
    };
    
    // Close all other items
    FAQComponent.prototype.closeOtherItems = function(currentQuestion) {
        var self = this;
        this.questions.forEach(function(question) {
            if (question !== currentQuestion && question.getAttribute('aria-expanded') === 'true') {
                question.setAttribute('aria-expanded', 'false');
                var content = question.nextElementSibling;
                if (content) {
                    self.closeItem(question, content);
                }
            }
        });
    };
    
    // Get open icon SVG
    FAQComponent.prototype.getCloseIcon = function() {
        return '<svg class="icon icon-arrow-square-down" aria-hidden="true"><use href="https://hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-down"></use></svg>';
    };
    
    // Get close icon SVG
    FAQComponent.prototype.getOpenIcon  = function() {
        return '<svg class="icon icon-arrow-square-up" aria-hidden="true"><use href="https://hdmplus.ir/si24/wp-content/themes/JTheme/src/images/sprite.svg#arrow-square-up"></use></svg>';
    };
})(); 