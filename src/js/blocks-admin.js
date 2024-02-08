// bundle.js
import $ from 'jquery';
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorControls } = wp.editor;
const { PanelBody, SelectControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;
let countdown;

const leadingZeroes = n => {
    return (n < 10 ? '0' : '') + n;
}

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
        window.acf.addAction('render_block_preview/type=countdown', ($block) => {
            const block = $block[0].querySelector('.block-countdown-timer');
            console.log(block);
            const target = block.dataset.targetDate;
            console.log(target);
            if(!target) return false; 
            const target_date = new Date(target).getTime();
            //Make sure timer stops at 0
            if(target_date - new Date().getTime() < 0) return false;
            const days_tile = block.querySelector('.days-tile');
            const hours_tile = block.querySelector('.hours-tile');
            const minutes_tile = block.querySelector('.minutes-tile');
            const seconds_tile = block.querySelector('.seconds-tile');
            
            const startCountdown = () => {
                let current_date = new Date().getTime();
                let seconds_left = (target_date - current_date) / 1000;
                if(seconds_left <= 0) stopCountdown();
                let days = leadingZeroes(parseInt(seconds_left / 86400));
                seconds_left = seconds_left % 86400;
            
                let hours = leadingZeroes(parseInt(seconds_left / 3600));
                seconds_left = seconds_left % 3600;
            
                let minutes = leadingZeroes(parseInt(seconds_left / 60));
                let seconds = leadingZeroes(parseInt(seconds_left % 60));
            
                days_tile.innerHTML = days;
                hours_tile.innerHTML = hours;
                minutes_tile.innerHTML = minutes;
                seconds_tile.innerHTML = seconds;
            }
            
            const stopCountdown = () => {
                clearInterval(countdown);
                days_tile.innerHTML = '00';
                hours_tile.innerHTML = '00';
                minutes_tile.innerHTML = '00';
                seconds_tile.innerHTML = '00';
            }
            clearInterval(countdown);
            countdown = setInterval(startCountdown, 1000);
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