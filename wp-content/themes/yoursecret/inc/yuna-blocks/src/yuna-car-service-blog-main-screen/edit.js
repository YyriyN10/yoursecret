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
import { InspectorControls, useBlockProps, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button,  } from '@wordpress/components';

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

	const { mainTitle, backgroundImageUrl} = attributes;

	const blockProps = useBlockProps();

	//Select image
	const onSelectImage = (media) => {
		setAttributes({
			backgroundImageUrl: ( media && media.url ) || '',
		});
	};


	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'yuna-car-service')}  >

					{backgroundImageUrl ? (
						<img src={backgroundImageUrl} style={{ maxWidth: '50%' }} />
					) : (
						<p> {__('Add background image', 'yuna-car-service')}</p>
					)}

					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectImage}
							allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
							render={({ open }) => (
								<Button onClick={open} variant="primary">
									{backgroundImageUrl ? __('Change background image', 'yuna-car-service') : __('Download background image', 'yuna-car-service')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</PanelBody>
			</InspectorControls>
			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<RichText
							tagName="h1"
							className={'block-title'}
							value={ attributes.mainTitle }
							placeholder={__('Page title', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ mainTitle: value })}
							allowedFormats={ [ 'core/text-color', 'core/bold', 'core/italic' ] }
						/>
					</div>
				</div>
			</section>
		</>
	);
}

