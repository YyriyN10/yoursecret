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
import { useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import {  Button } from '@wordpress/components';




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

	const { videoUrl} = attributes;

	const blockProps = useBlockProps();

	//Select image
	const onSelectVideo = (media) => {
		setAttributes({
			videoUrl: media?.url || '',
		});
	};

	return (
		<>
			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						{videoUrl ? (
							<video src={videoUrl} alt="icon" />
						) : (
							<p>{__('Add video', 'yoursecret')}</p>
						)}

						<MediaUploadCheck>
							<MediaUpload
								onSelect={onSelectVideo}
								allowedTypes={['video/mp4', 'video/webm']}
								render={({ open }) => (
									<Button onClick={open} variant="primary">
										{videoUrl ? __('Change video', 'yoursecret') : __('Add video', 'yoursecret')}
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

