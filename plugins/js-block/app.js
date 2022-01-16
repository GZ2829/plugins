wp.blocks.registerBlockType("ourplugin/js-block", {
  title: 'JS Block Test',
  icon: 'smiley',
  category: 'common',
  edit: function(){
    return wp.element.createElement('h3', null 'Hello, this is from the admin screen');
  },
  save: function(){
    return wp.element.createElement('h3', null 'Hello, this is from the public screen');
  }
})
