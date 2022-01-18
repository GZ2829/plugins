const { registerBlockType } = window.wp.blocks;

registerBlockType("ourplugin/example-custom-block", {
  title: 'JS Block Test',
  icon: 'wordpress-alt',
  category: 'common',
  edit: function () {
    return (
      <div>
        <h3>Hello from chello mello!!</h3>
      </div>
    )
  },
  save: function () {
    return <h1>1,2,3</h1>
  }
})
