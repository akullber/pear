import './style.scss';
const { registerBlockType } = wp.blocks;
const { useBlockProps } = wp.blockEditor;

registerBlockType('pear/accordion', {
  title: 'Accordion Block',
  icon: 'smiley',
  category: 'common',
  edit: () => {
    const blockProps = useBlockProps();
    return <div {...blockProps}>Card Content</div>;
  },
  save: () => {
    const blockProps = useBlockProps.save();
    return <div {...blockProps}>Card Content</div>;
  },
});
