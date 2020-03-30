/**
 * BLOCK: agiledrop column-2
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
//import './editor.scss';
//import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
const { MediaUploadCheck, MediaUpload } = wp.blockEditor;
let el = wp.element.createElement;
let i18n = wp.i18n;

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'agiledrop/column-2', {
    title: __( '2-column block', 'agiledrop' ),
    description: __('Block showing title, description, image and class', 'agiledrop' ),
    icon: 'shield',
    category: 'common',
    keywords: [
        __( 'agiledrop', '2-column' ),
    ],
    attributes: {
        title: {
            type: 'string'
        },
        description: {
            type: 'string'
        },
        image: {
            type: 'string'
        },
        position: {
            type: 'string',
        },
    },

    edit: function ( props ) {

        console.log( props.attributes.position )

        function updateTitle( event ) {
            props.setAttributes( {
                title: event.target.value,
            } );
        }

        function updateDescription( event ) {
            props.setAttributes( {
                description: event.target.value,
            } );
        }

        function updateImage( event ) {
            props.setAttributes( {
                image: event.sizes.full.url,
            } );
        }

        function updatePosition() {
            props.setAttributes( {
                position: document.getElementById("selectClass").value
            } );
        }

        return el( "div", null,
            el( "label",{for: "title"}, "Insert your title:" ),
            el( "input",{type: "text", id: "title", name: "title", onChange: updateTitle, value: props.attributes.title}),
            el( "label", {for: "description"}, "Insert your description" ),
            el("textarea", {id:"description", name: "description", rows: 10, cols: 65, onChange:updateDescription, value:props.attributes.description}),
            el( "label", {for: "position"}, "select position of image" ),
            el( "select", {id: "selectClass", onChange:updatePosition },
                el("option", { value: 'left' }, "left" ),
                el("option", { value: 'right'}, "right" ),
            ),
            el("img", {src:props.attributes.image}),
            el(MediaUploadCheck, null,
                el( MediaUpload, {onSelect: updateImage, type: "image", value: props.attributes.image,
                    render: function ( obj ) {
                        return el( "button", {
                            onClick: obj.open,
                            className: 'button button-large'
                        }, __('Upload Image'))
                    }
                })
            )
        );
    },


    save: function() {
        return null;
    },
} );
