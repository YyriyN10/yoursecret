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
import { InspectorControls, useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, Button,  } from '@wordpress/components';


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

	const { imageUrl, imageId, imageAlt, bgImageUrl, bgImageId, bgImageAlt} = attributes;

	const blockProps = useBlockProps();

	//Select image
	const onSelectImage = (media) => {
		setAttributes({
			imageUrl: media?.url || '',
			imageId: media?.id || '',
			imageAlt: media?.alt || '',
		});
	};

	//Select image
	const onSelectBg = (media) => {
		setAttributes({
			bgImageUrl: media?.url || '',
			bgImageId: media?.id || '',
			bgImageAlt: media?.alt || '',
		});
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Settings', 'yoursecret')}  >

					{bgImageUrl ? (
						<img src={bgImageUrl} alt={bgImageAlt} />
					) : (
						<p>{__('Add bg image', 'yoursecret')}</p>
					)}

					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectBg}
							allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
							render={({ open }) => (
								<Button onClick={open} variant="primary">
									{bgImageUrl ? __('Change bg image', 'yoursecret') : __('Add bg image', 'yoursecret')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</PanelBody>
			</InspectorControls>
			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						{imageUrl ? (
							<img src={imageUrl} alt={imageAlt} />
						) : (
							<p>{__('Add image', 'yoursecret')}</p>
						)}

						<MediaUploadCheck>
							<MediaUpload
								onSelect={onSelectImage}
								allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
								render={({ open }) => (
									<Button onClick={open} variant="primary">
										{imageUrl ? __('Change image', 'yoursecret') : __('Add image', 'yoursecret')}
									</Button>
								)}
							/>
						</MediaUploadCheck>
					</div>
				</div>
			</section>
		</>
	);
}

