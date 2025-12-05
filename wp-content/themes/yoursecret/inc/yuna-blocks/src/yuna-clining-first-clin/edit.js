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
import { InspectorControls, useBlockProps, RichText, MediaUpload, MediaUploadCheck} from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button } from '@wordpress/components';
import { useSelect } from '@wordpress/data';


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

	const { blockText, blockTitle, blockList, anchorId, topIndent, bottomIndent, image1Url, image1Id, image1Alt, image2Url, image2Id, image2Alt, image3Url, image3Id, image3Alt} = attributes;

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


	//Select image
	const onSelectImage1 = (media) => {
		setAttributes({
			image1Url: media?.url || '',
			image1Id: media?.id || 0,
			image1Alt: media?.alt || '',
		});
	};

	const onSelectImage2 = (media) => {
		setAttributes({
			image2Url: media?.url || '',
			image2Id: media?.id || 0,
			image2Alt: media?.alt || '',
		});
	};

	const onSelectImage3 = (media) => {
		setAttributes({
			image3Url: media?.url || '',
			image3Id: media?.id || 0,
			image3Alt: media?.alt || '',
		});
	};


	return (
		<>
			<InspectorControls>
				<PanelBody title={'Settings'}  >

					<TextControl
						label={'Якір блоку'}
						help={'Це ідентеуфікатор блоку, він має бути унікальним. За його допомогою можна звернутися до блоку в меню тощо'}
						value={ anchorId || ''}
						onChange={ (value)=> setAttributes({ anchorId: value })}
					/>
					<SelectControl
						label={__('Верхній внутрішній відступ')}
						value={topIndent}
						options={topIndentOptions}
						onChange={(value) => setAttributes({ topIndent: value })}
					/>

					<SelectControl
						label={__('Нижній внутрішній відступ')}
						value={bottomIndent}
						options={bottomIndentOptions}
						onChange={(value) => setAttributes({ bottomIndent: value })}
					/>

				</PanelBody>
			</InspectorControls>

			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<div className="image-block">
							{image1Url ? (
								<img src={image1Url} alt={image1Alt} style={{ maxWidth: '50%' }} />
							) : (
								<p>Зображення 1 не вибрано</p>
							)}

							<MediaUploadCheck>
								<MediaUpload
									onSelect={onSelectImage1}
									allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
									render={({ open }) => (
										<Button onClick={open} variant="primary">
											{image1Url ? 'Змінити зображення 1' : 'Завантажити зображення 1'}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<div className="image-block">
							{image2Url ? (
								<img src={image2Url} alt={image2Alt} style={{ maxWidth: '50%' }} />
							) : (
								<p>Зображення 2 не вибрано</p>
							)}

							<MediaUploadCheck>
								<MediaUpload
									onSelect={onSelectImage2}
									allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
									render={({ open }) => (
										<Button onClick={open} variant="primary">
											{image2Url ? 'Змінити зображення 2' : 'Завантажити зображення 2'}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<div className="image-block">
							{image3Url ? (
								<img src={image3Url} alt={image3Alt} style={{ maxWidth: '50%' }} />
							) : (
								<p>Зображення 3 не вибрано</p>
							)}

							<MediaUploadCheck>
								<MediaUpload
									onSelect={onSelectImage3}
									allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
									render={({ open }) => (
										<Button onClick={open} variant="primary">
											{image3Url ? 'Змінити зображення 3' : 'Завантажити зображення 3'}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<RichText
							tagName="h2"
							className={'block-title'}
							value={ attributes.blockTitle }
							placeholder={'Заголовок блоку'}
							onChange={ (value)=>setAttributes({ blockTitle: value })}
							allowedFormats={ [] }
						/>
						<RichText
							tagName="div"
							multiline="p"
							identifier="blockText"
							className={'block-text'}
							value={ attributes.blockText }
							placeholder={'Текст блоку'}
							onChange={ (value)=>setAttributes({ blockText: value })}
							allowedFormats={ [ 'core/bold', 'core/link', 'core/text-color' ] }
							onSplit={() => {}}
						/>
						<RichText
							tagName="ul"
							multiline="li"
							identifier="blockList"
							className={'block-list'}
							value={ attributes.blockList }
							placeholder={'Елемннт переліку'}
							onChange={ (value)=>setAttributes({ blockList: value })}
							allowedFormats={ [ 'core/bold', 'core/link', 'core/text-color' ] }
							onSplit={() => {}}
						/>
					</div>
				</div>
			</section>
		</>
	);
}
