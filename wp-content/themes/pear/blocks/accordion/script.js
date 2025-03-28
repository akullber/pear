/**
 * Accordion Component JavaScript
 * 
 */

document.addEventListener('DOMContentLoaded', function() {
    // Select all accordion containers on the page
    const accordions = document.querySelectorAll('.accordion');
    
    // Initialize each accordion instance
    accordions.forEach(accordion => {
        // Get all trigger buttons within this accordion
        const triggers = accordion.querySelectorAll('.accordion__trigger');
        
        // Set up click handlers for each trigger
        triggers.forEach(trigger => {
            // Find the associated panel (content) that follows the trigger's header
            const panel = trigger.closest('.accordion__header').nextElementSibling;
            
            // Skip if no panel is found (defensive programming)
            if (!panel) return;

            // Add click event listener to handle panel toggling
            trigger.addEventListener('click', () => {
                // Check if the current panel is expanded
                const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
                
                // Close all other panels in this accordion group
                triggers.forEach(otherTrigger => {
                    if (otherTrigger !== trigger) {
                        otherTrigger.setAttribute('aria-expanded', 'false');
                        otherTrigger.closest('.accordion__header').nextElementSibling.hidden = true;
                    }
                });

                // Toggle the clicked panel's state
                // - Update ARIA attribute for accessibility
                // - Toggle visibility using the hidden attribute
                trigger.setAttribute('aria-expanded', !isExpanded);
                panel.hidden = isExpanded;
            });
        });
    });
}); 