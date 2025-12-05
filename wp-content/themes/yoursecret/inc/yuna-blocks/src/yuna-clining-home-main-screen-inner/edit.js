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
import { useBlockProps, MediaUpload, MediaUploadCheck, RichText } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEffect } from '@wordpress/element';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes, clientId }) {

	const {imageUrl, imageId, imageAlt, serviceName} = attributes;

	//Block index
	const { blockIndexAttr } = { blockIndexAttr: attributes.blockIndex ?? 0 };

	const index = useSelect( ( select ) => {
		const be = select( 'core/block-editor' );
		const rootId = be.getBlockRootClientId( clientId );        // батьківський блок
		const idx = be.getBlockIndex( clientId, rootId );           // 0-based індекс
		return typeof idx === 'number' ? idx : 0;
	}, [ clientId ] );

	useEffect( () => {
		if ( index !== blockIndexAttr ) {
			setAttributes( { blockIndex: index } );
		}
	}, [ index ] );

	const blockProps = useBlockProps();

	//Select icon
	const onSelectImage = (media) => {
		setAttributes({
			imageUrl: media?.url || '',
			imageId: media?.id || 0,
			imageAlt: media?.alt || '',
		});
	};


	return (
		<>
			<div { ...blockProps } >

				<div className="image-block">
					{imageUrl ? (
						<img src={imageUrl} alt={imageAlt} style={{ maxWidth: '50%' }} />
					) : (
						<p>Зображення послуги не вибрано</p>
					)}

					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectImage}
							allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
							render={({ open }) => (
								<Button onClick={open} variant="primary">
									{imageUrl ? 'Змінити зображення послуги' : 'Завантажити зображення послуги'}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				</div>
				<RichText
					tagName="p"
					className="block-text"
					value={ attributes.serviceName }
					placeholder="Назва послуги"
					onChange={(value)=>setAttributes({ serviceName: value })}
					allowedFormats={[ 'core/bold', 'core/italic', 'core/link' ]}
				/>
			</div>
		</>
	);
}
