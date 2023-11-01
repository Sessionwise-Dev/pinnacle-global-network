// bundle.js
import $ from 'jquery';
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

$(document).on('ready', () => {
    if(window.acf){
        window.acf.addAction('render_block_preview/type=image', ($block) => {
            if(!$block[0].querySelector('img')){
                let inner = $block[0].querySelector('.block-image');
                let img = document.createElement('img');
                img.classList.add('placeholder-image');
                img.src = theme.templateURL + '/dist/images/img-placeholder-16x9.svg';
                inner.appendChild(img);
            } else {
                let inner = $block[0].querySelector('.block-image');
                let placeholder = inner.querySelector('.placeholder-image');
                if(placeholder) placeholder.remove();
            }
        });
    }
});

const blocksWithSpacingControl = [
    'core/paragraph',
    'core/list',
    'core/heading'
];

const spacingOptions = [
    {
        label: __( 'None' ),
        value: 'none'
    },
    {
        label: __( 'XS' ),
        value: 'xs'
    },
    {
        label: __( 'SM' ),
        value: 'sm'
    },
    {
        label: __( 'MD' ),
        value: 'md'
    },
    {
        label: __( 'LG' ),
        value: 'lg'
    },
    {
        label: __( 'XL' ),
        value: 'xl'
    },
];

const addSpacingControlAttribute = (settings, blockName) => {
    if(!blocksWithSpacingControl.includes(blockName)) return settings;
    settings.attributes.spacing = {
        type: 'string',
        default: spacingOptions[2].value
    };
    settings.supports.className = true;
    return settings;
};

addFilter(
    'blocks.registerBlockType',
    'pgn/attribute/spacing',
    addSpacingControlAttribute
);

// Filter out spacing css classes to preserve other additional classes
const removeFromClassName = ( className = '', classArray ) => {
	return className.split( ' ' )
		.filter( classString => ! classArray.includes( classString ) )
		.join( ' ' )
		.replace( /\s+/g, ' ' ) // Remove superfluous whitespace
		.trimStart();
};

const withSpacingControl = createHigherOrderComponent(BlockEdit => {
    return props => {
        // Do nothing if it's another block than our defined ones.
        if (!blocksWithSpacingControl.includes(props.name)) {
            return (
                <BlockEdit { ...props } />
            );
        }

        const {spacing, className} = props.attributes;
        const spacingClasses = spacingOptions.map(opt => 'mt-' + opt.value)
        const classNameWithoutSpacing = removeFromClassName(className, spacingClasses);
        props.attributes.className = spacing ?
				`mt-${ spacing } ${ classNameWithoutSpacing }` :
				classNameWithoutSpacing;

        return (
            <Fragment>
                <BlockEdit {...props} />
                <InspectorControls>
                    <PanelBody title={ __('Space Above')} initialOpen = {true}>
                        <SelectControl
                            value={ spacing }
                            options={ spacingOptions }
                            onChange={ ( selectedSpacingOption ) => {
                                props.setAttributes( {
                                    spacing: selectedSpacingOption,
                                } );
                            } }
                        />
                    </PanelBody>
                </InspectorControls>
            </Fragment>
        );
    }
}, 'withSpacingControl');

addFilter( 'editor.BlockEdit', 'pgn/with-spacing-control', withSpacingControl );