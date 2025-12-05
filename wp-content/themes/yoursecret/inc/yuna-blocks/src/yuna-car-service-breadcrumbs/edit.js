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
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, Button,  } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

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

	const { parentPage } = attributes;

	const blockProps = useBlockProps();

	// Отримуємо сторінку призначення
	const pagesList = useSelect(
		(select) => select('core').getEntityRecords('postType', 'page', { per_page: -1 }),
		[]
	);

	const pagesListOptions = pagesList
		? pagesList.map((page) => ({ label: page.title.rendered, value: page.id }))
		: [];

	pagesListOptions.unshift({ label: __('Chose parent page', 'yuna-car-service' ), value: 0 });


	return (
		<>

			<section { ...blockProps } >
				<div className="container">
					<div className="row">
						<SelectControl
							label={__('Chose parent page', 'yuna-car-service')}
							value={parentPage}
							options={[
								{ label: __('Chose parent page', 'yuna-car-service'), value: 0 },
								...(pagesList
									? pagesList.map((p) => ({ label: p.title.rendered, value: p.id }))
									: []),
							]}
							onChange={(value) => setAttributes({parentPage: parseInt(value, 10) || 0 })}
						/>
					</div>
				</div>
			</section>
		</>
	);
}

