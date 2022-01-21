import './functions.js'

const { registerBlockType } = window.wp.blocks;

registerBlockType("ourplugin/example-custom-block", {
  title: 'JS Block Test',
  icon: 'wordpress-alt',
  category: 'common',
  attributes:{
    dayVarb: {type: "string"},
    nightVarb: {type: "string"},
  },
  edit: function (props) {
    function updateDayVerb(e) {
      props.setAttributes({dayVarb: e.target.value})
    }

    function updateNightVerb(e) {
      props.setAttributes({nightVarb: e.target.value})
    }
    return (
      <div>
        <input placeholder="day variable" value={props.attributes.dayVarb} onChange={updateDayVerb}/>
        <input placeholder="night variable" value={props.attributes.nightVarb} onChange={updateNightVerb}/>
      </div>
    )
  },
  save: function (props) {
    null
  },
})
