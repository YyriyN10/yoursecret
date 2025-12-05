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

	const { blockName, blockTitle, blockText, blockList, anchorId, topIndent, bottomIndent, image1Url, image1Id, image1Alt, image2Url, image2Id, image2Alt, btnText, btnTarget, experienceNumber, experienceText} = attributes;

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

	// Отримуємо сторінку призначення
	const pagesList = useSelect(
		(select) => select('core').getEntityRecords('postType', 'page', { per_page: -1 }),
		[]
	);

	const pagesListOptions = pagesList
		? pagesList.map((page) => ({ label: page.title.rendered, value: page.id }))
		: [];

	pagesListOptions.unshift({ label: __('Select target page', 'yuna-car-service'), value: 0 });


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
				<PanelBody title={__('Button', 'yuna-car-service')}>
					<TextControl
						label={__('Button text', 'yuna-car-service')}
						value={ btnText || ''}
						onChange={ (value)=> setAttributes({ btnText: value })}
					/>
					<SelectControl
						label={__('Select target page', 'yuna-car-service')}
						value={btnTarget}
						options={[
							{ label: __('Select target page', 'yuna-car-service'), value: 0 },
							...(pagesList
								? pagesList.map((p) => ({ label: p.title.rendered, value: p.id }))
								: []),
						]}
						onChange={(value) => setAttributes({ btnTarget: parseInt(value, 10) || 0 })}
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
								<p>{__('Big image not adding', 'yuna-car-service')}</p>
							)}

							<MediaUploadCheck>
								<MediaUpload
									onSelect={onSelectImage1}
									allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
									render={({ open }) => (
										<Button onClick={open} variant="primary">
											{image1Url ? __('Change big image', 'yuna-car-service') : __('Add big image', 'yuna-car-service')}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<div className="image-block">
							{image2Url ? (
								<img src={image2Url} alt={image2Alt} style={{ maxWidth: '50%' }} />
							) : (
								<p>{__('Small image not adding', 'yuna-car-service')}</p>
							)}

							<MediaUploadCheck>
								<MediaUpload
									onSelect={onSelectImage2}
									allowedTypes={['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']}
									render={({ open }) => (
										<Button onClick={open} variant="primary">
											{image2Url ? __('Change small image', 'yuna-car-service') : __('Add small image', 'yuna-car-service')}
										</Button>
									)}
								/>
							</MediaUploadCheck>
						</div>
						<RichText
							tagName="h3"
							className={'block-name'}
							value={ attributes.blockName }
							placeholder={__('Block name', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockName: value })}
							allowedFormats={ [] }
						/>
						<RichText
							tagName="h2"
							className={'block-title'}
							value={ attributes.blockTitle }
							placeholder={__('Block title', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockTitle: value })}
							allowedFormats={ ['core/text-color'] }
						/>
						<RichText
							tagName="div"
							multiline="p"
							identifier="blockText"
							className={'block-text'}
							value={ attributes.blockText }
							placeholder={__('Block text', 'yuna-car-service')}
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
							placeholder={__('Advantage', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ blockList: value })}
							allowedFormats={ [ 'core/bold', 'core/link', 'core/text-color' ] }
							onSplit={() => {}}
						/>
						<RichText
							tagName="p"
							className={'experience-number'}
							value={ attributes.experienceNumber }
							placeholder={__('Years of experience', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ experienceNumber: value })}
							allowedFormats={ [] }
						/>
						<RichText
							tagName="p"
							className={'experience-text'}
							value={ attributes.experienceText }
							placeholder={__('Experience description', 'yuna-car-service')}
							onChange={ (value)=>setAttributes({ experienceText: value })}
							allowedFormats={ [] }
						/>
					</div>
				</div>
			</section>
		</>
	);
}
