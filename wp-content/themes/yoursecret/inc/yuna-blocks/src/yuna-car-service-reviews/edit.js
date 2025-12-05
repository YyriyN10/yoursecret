/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InspectorControls, useBlockProps, RichText} from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl} from '@wordpress/components';

// беремо enum прямо з block.json
import metadata from './block.json';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
/*import '../main-block/editor.scss';*/

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {

	const { blockName, blockTitle, blockText, anchorId, topIndent, bottomIndent} = attributes;

	const blockProps = useBlockProps({
		className: topIndent + ' ' + bottomIndent
	});


	// Отримуємо enum bottomIndent з block.json
	const bottomIndentOptions = metadata.attributes.bottomIndent.enum.map((value) => ({
		label: value,
		value: value,
	}));

	// Отримуємо enum topIndent з block.json
	const topIndentOptions = metadata.attributes.topIndent.enum.map((value) => ({
		label: value,
		value: value,
	}));


	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'yuna-car-service')}  >

					<TextControl
						label={__('Anchor', 'yuna-car-service')}
						help={__('This is the block identifier, it must be unique. You can use it to refer to the block in menus, etc.', 'yuna-car-service')}
						value={ anchorId || ''}
						onChange={ (value)=> setAttributes({ anchorId: value })}
					/>
					<SelectControl
						label={__('Top indent', 'yuna-car-service')}
						value={topIndent}
						options={topIndentOptions}
						onChange={(value) => setAttributes({ topIndent: value })}
					/>

					<SelectControl
						label={__('Bottom indent', 'yuna-car-service')}
						value={bottomIndent}
						options={bottomIndentOptions}
						onChange={(value) => setAttributes({ bottomIndent: value })}
					/>

				</PanelBody>
			</InspectorControls>

			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<RichText
							tagName="h3"
							className={'block-name'}
							value={ attributes.blockName }
							placeholder={__('Block name', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockName: value })}
							allowedFormats={ [ ] }
						/>
						<RichText
							tagName="h2"
							className={'block-title'}
							value={ attributes.blockTitle }
							placeholder={__('Block title', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockTitle: value })}
							allowedFormats={ [ 'core/text-color' ] }
						/>
						<RichText
							tagName="p"
							className={'block-text'}
							value={ attributes.blockText }
							placeholder={__('Block text', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockText: value })}
							allowedFormats={ [ 'core/bold', 'core/text-color', ['core/link'] ] }
						/>
					</div>
				</div>
			</section>
		</>
	);
}
