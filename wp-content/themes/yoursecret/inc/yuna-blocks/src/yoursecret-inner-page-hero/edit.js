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
import { useBlockProps, RichText } from '@wordpress/block-editor';



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

	const { pageTitle, sectionText} = attributes;

	const blockProps = useBlockProps();

	return (
		<>
			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<RichText
							tagName="h2"
							className={'block-title'}
							value={ attributes.pageTitle }
							placeholder={__('Page title', 'yoursecret')}
							onChange={ (value)=>setAttributes({ pageTitle: value })}
							allowedFormats={ [ 'core/text-color', 'core/bold', 'core/link' ] }
						/>
						<RichText
							tagName="div"
							multiline="p"
							identifier="blockText"
							className={'block-text'}
							value={ attributes.sectionText }
							placeholder={__('Section text', 'yoursecret')}
							onChange={ (value)=>setAttributes({ sectionText: value })}
							allowedFormats={ [ 'core/bold', 'core/link', 'core/text-color' ] }
							onSplit={() => {}}
						/>
					</div>
				</div>
			</section>
		</>
	);
}

