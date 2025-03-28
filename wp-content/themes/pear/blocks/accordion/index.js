/**
 * Accordion Block
 * 
 * This block creates an interactive accordion component that allows users to:
 * - Add multiple accordion items
 * - Edit titles and content for each item
 * - Remove individual items
 * - Toggle accordion panels (in the frontend)
 */

import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import './style.css';

// Register the accordion block with WordPress
registerBlockType('pear/accordion', {
    edit: ({ attributes, setAttributes }) => {
        // Destructure items from attributes with a default empty array
        const { items = [] } = attributes;
        
        // Get block props and add the base accordion class
        const blockProps = useBlockProps({
            className: 'accordion'
        });

        /**
         * Adds a new empty accordion item to the list
         * Each item contains a title and content field
         */
        const addNewItem = () => {
            setAttributes({
                items: [
                    ...items,
                    {
                        title: '',
                        content: ''
                    }
                ]
            });
        };

        /**
         * Updates a specific property of an accordion item
         * @param {number} index - The index of the item to update
         * @param {string} property - The property to update (title or content)
         * @param {string} value - The new value for the property
         */
        const updateItem = (index, property, value) => {
            const newItems = [...items];
            newItems[index] = {
                ...newItems[index],
                [property]: value
            };
            setAttributes({ items: newItems });
        };

        /**
         * Removes an accordion item from the list
         * @param {number} index - The index of the item to remove
         */
        const removeItem = (index) => {
            const newItems = items.filter((_, i) => i !== index);
            setAttributes({ items: newItems });
        };

        return (
            <div {...blockProps}>
                {/* Render each accordion item */}
                {items.map((item, index) => (
                    <div key={index} className="accordion__item">
                        {/* Accordion header with title */}
                        <h3 className="accordion__header">
                            <div className="accordion__trigger">
                                <RichText
                                    tagName="span"
                                    className="accordion__title"
                                    value={item.title}
                                    onChange={(value) => updateItem(index, 'title', value)}
                                    placeholder={__('Enter title...', 'pear')}
                                    allowedFormats={['core/bold', 'core/italic']}
                                />
                                {/* Chevron icon for visual indication */}
                                <svg className="accordion__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                                </svg>
                            </div>
                        </h3>

                        {/* Accordion panel with content */}
                        <div className="accordion__panel">
                            <RichText
                                tagName="div"
                                className="accordion__content"
                                value={item.content}
                                onChange={(value) => updateItem(index, 'content', value)}
                                placeholder={__('Enter content...', 'pear')}
                                allowedFormats={['core/bold', 'core/italic', 'core/link']}
                            />
                            {/* Remove item button */}
                            <Button
                                variant="secondary"
                                className="accordion__remove-item"
                                onClick={() => removeItem(index)}
                                isDestructive
                            >
                                {__('Remove Item', 'pear')}
                            </Button>
                        </div>
                    </div>
                ))}

                {/* Add new accordion item button */}
                <Button
                    variant="primary"
                    className="accordion__add-item"
                    onClick={addNewItem}
                >
                    {__('Add Accordion Item', 'pear')}
                </Button>
            </div>
        );
    },

    /**
     * Frontend save component
     * Renders the accordion in its final form with proper accessibility attributes
     * and hidden panels that will be toggled via JavaScript
     */
    save: ({ attributes }) => {
        const { items = [] } = attributes;
        const blockProps = useBlockProps.save({
            className: 'accordion'
        });

        return (
            <div {...blockProps}>
                {items.map((item, index) => (
                    <div key={index} className="accordion__item">
                        <h3 className="accordion__header">
                            {/* Accessible button for toggling accordion panels */}
                            <button
                                type="button"
                                className="accordion__trigger"
                                aria-expanded="false"
                            >
                                <span className="accordion__title">
                                    {item.title}
                                </span>
                                <svg className="accordion__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
                                </svg>
                            </button>
                        </h3>

                        {/* Accordion panel that will be toggled */}
                        <div
                            className="accordion__panel"
                            hidden
                        >
                            <div className="accordion__content">
                                {item.content}
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        );
    },
});
