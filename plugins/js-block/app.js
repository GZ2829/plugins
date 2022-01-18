
const { registerBlockType } = window.wp.blocks;

registerBlockType("ourplugin/example-custom-block", {
  title: 'JS Block Test',
  icon: 'wordpress-alt',
  category: 'common',
  edit: function () {
    return "hello"
  },
  save: function () {
    return "Hey"
  }
})
