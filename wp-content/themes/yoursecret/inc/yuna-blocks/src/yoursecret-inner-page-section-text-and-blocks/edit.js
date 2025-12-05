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
import { InspectorControls, useBlockProps, RichText, InnerBlocks, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, Button, TextControl, ToggleControl } from '@wordpress/components';



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

	const { sectionTitle, sectionText, sectionList, arrowImage, btnText, btnLink, btnCall, lastInPage, blueDecorToggle} = attributes;

	const blockProps = useBlockProps();

	const TEMPLATE = [
		['yoursecret/inner-page-section-text-and-blocks-inner', {}]
	];

	const ALLOWED = [
		'yoursecret/inner-page-section-text-and-blocks-inner',
	];

	//Select image
	const onSelectImage = (media) => {
		setAttributes({
			arrowImage: media?.url || '',
		});
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'yoursecret')}  >

					{arrowImage ? (
						<img src={arrowImage} alt="icon" />
					) : (
						<p>{__('Add icon in arrow', 'yoursecret')}</p>
					)}

					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectImage}
							allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
							render={({ open }) => (
								<Button onClick={open} variant="primary">
									{arrowImage ? __('Change icon in arrow', 'yoursecret') : __('Add icon in arrow', 'yoursecret')}
								</Button>
							)}
						/>
					</MediaUploadCheck>

				</PanelBody>
				<PanelBody title={__('Section option', 'yoursecret')}  >
					<ToggleControl
						label={__('Last section in page?', 'yoursecret')}
						checked={lastInPage}
						onChange={(value) => setAttributes({ lastInPage: value })}
					/>
					<ToggleControl
						label={__('Remove the decorative blue circle from the title?', 'yoursecret')}
						checked={blueDecorToggle}
						onChange={(value) => setAttributes({ blueDecorToggle: value })}
					/>
				</PanelBody>
				<PanelBody title={__('Button settings', 'yoursecret')}  >
					<TextControl
						label={__('Button text', 'yoursecret')}
						value={ btnText || ''}
						onChange={ (value)=> setAttributes({ btnText: value })}
					/>
					<TextControl
						label={__('Button link', 'yoursecret')}
						value={ btnLink || ''}
						onChange={ (value)=> setAttributes({ btnLink: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<RichText
							tagName="h2"
							className={'block-title'}
							value={ attributes.sectionTitle }
							placeholder={__('Section title', 'yoursecret')}
							onChange={ (value)=>setAttributes({ sectionTitle: value })}
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
						<RichText
							tagName="ul"
							multiline="li"
							identifier="blockList"
							className={'block-text'}
							value={ attributes.sectionList }
							placeholder={__('Section list', 'yoursecret')}
							onChange={ (value)=>setAttributes({ sectionList: value })}
							allowedFormats={ [ 'core/bold', 'core/link', 'core/text-color' ] }
							onSplit={() => {}}
						/>
						<InnerBlocks
							template={TEMPLATE}
							allowedBlocks={ALLOWED}
							templateLock={false}
						/>
						<RichText
							tagName="p"
							className={'btn-call'}
							value={ attributes.btnCall }
							placeholder={__('Button call', 'yoursecret')}
							onChange={ (value)=>setAttributes({ btnCall: value })}
							allowedFormats={ [ 'core/text-color', 'core/bold', 'core/link' ] }
						/>
					</div>
				</div>
			</section>
		</>
	);
}

