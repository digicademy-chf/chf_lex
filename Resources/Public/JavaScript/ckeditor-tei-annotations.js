/**
 * @license This file is part of the extension CHF Lex for TYPO3.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 * 
 * Based on https://github.com/ckeditor/ckeditor5/blob/master/packages/ckeditor5-html-support/tests/manual/customelements.js
 */

import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
import Plugin from '@ckeditor/ckeditor5-core/src/plugin';
import SourceEditing from '@ckeditor/ckeditor5-source-editing/src/sourceediting';
import GeneralHtmlSupport from '@ckeditor/ckeditor5-html-support/src/generalhtmlsupport';

/**
 * Custom plugin to enable a few TEI annotations in the RTE
 */
class TEIAnnotationSupport extends Plugin {
    static get requires() {
        return [GeneralHtmlSupport];
    }

    init() {
        const dataFilter = this.editor.plugins.get('DataFilter');
        const dataSchema = this.editor.plugins.get('DataSchema');

        // List of inline elements to support
        dataSchema.registerInlineElement({
            view: 'author',
            model: 'teiAuthor'
        });
        dataSchema.registerInlineElement({
            view: 'persName',
            model: 'teiPersName'
        });
        dataSchema.registerInlineElement({
            view: 'surname',
            model: 'teiSurname'
        });
        dataSchema.registerInlineElement({
            view: 'forename',
            model: 'teiForename'
        });
        dataSchema.registerInlineElement({
            view: 'placeName',
            model: 'teiPlaceName'
        });
        dataSchema.registerInlineElement({
            view: 'country',
            model: 'teiCountry'
        });
        dataSchema.registerInlineElement({
            view: 'region',
            model: 'teiRegion'
        });
        dataSchema.registerInlineElement({
            view: 'settlement',
            model: 'teiSettlement'
        });
        dataSchema.registerInlineElement({
            view: 'district',
            model: 'teiDistrict'
        });
        dataSchema.registerInlineElement({
            view: 'geogName',
            model: 'teiGeogName'
        });
        dataSchema.registerInlineElement({
            view: 'lang',
            model: 'teiLang'
        });
        dataSchema.registerInlineElement({
            view: 'mentioned',
            model: 'teiMentioned'
        });
        dataSchema.registerInlineElement({
            view: 'gloss',
            model: 'teiGloss'
        });
        dataSchema.registerInlineElement({
            view: 'etym',
            model: 'teiEtym'
        });
        dataSchema.registerInlineElement({
            view: 'gramGrp',
            model: 'teiGramGrp'
        });
        dataSchema.registerInlineElement({
            view: 'gram',
            model: 'teiGram'
        });
        dataSchema.registerInlineElement({
            view: 'm',
            model: 'teiM'
        });
        dataSchema.registerInlineElement({
            view: 'case',
            model: 'teiCase'
        });
        dataSchema.registerInlineElement({
            view: 'number',
            model: 'teiNumber'
        });
        /*dataSchema.registerInlineElement( {
            view: 'ref',
            model: 'teiRef'
        } );*/
        dataSchema.registerInlineElement({
            view: 'cit',
            model: 'teiCit'
        });
        dataSchema.registerInlineElement({
            view: 'q',
            model: 'teiQ'
        });
        dataSchema.registerInlineElement({
            view: 'bibl',
            model: 'teiBibl'
        });
        dataSchema.registerInlineElement({
            view: 'date',
            model: 'teiDate'
        });
        dataSchema.registerInlineElement({
            view: 'biblScope',
            model: 'teiBiblScope'
        });

        // Allow and filter custom elements (cannot be done in the regular config)
        dataFilter.allowElement('author');
        dataFilter.allowElement('persName');
        dataFilter.allowElement('surname');
        dataFilter.allowElement('forename');
        dataFilter.allowElement('placeName');
        dataFilter.allowElement('country');
        dataFilter.allowAttributes({ name: 'country', attributes: { 'key': true } });
        dataFilter.allowElement('region');
        dataFilter.allowElement('settlement');
        dataFilter.allowElement('district');
        dataFilter.allowElement('geogName');
        dataFilter.allowAttributes({ name: 'geogName', attributes: { 'type': /^(agronym|hydronym|hodonym)$/ } });
        dataFilter.allowElement('lang');
        dataFilter.allowAttributes({ name: 'lang', attributes: { 'xml:lang': true } });
        dataFilter.allowElement('mentioned');
        dataFilter.allowAttributes({ name: 'mentioned', attributes: { 'type': 'etymon' } });
        dataFilter.allowElement('gloss');
        dataFilter.allowElement('etym');
        dataFilter.allowElement('gramGrp');
        dataFilter.allowElement('gram');
        dataFilter.allowAttributes({ name: 'gram', attributes: { 'type': 'word_formation' } });
        dataFilter.allowElement('m');
        dataFilter.allowAttributes({ name: 'm', attributes: { 'type': /^(bridging_element|word_formation_morpheme|flexion_morpheme|onymic|open|unclear)$/ } });
        dataFilter.allowElement('case');
        dataFilter.allowAttributes({ name: 'case', attributes: { 'value': /^(nominative|genetive|dative|accusative|locative|ablative|instrumental|vocative|prepositional)$/ } });
        dataFilter.allowElement('number');
        dataFilter.allowAttributes({ name: 'number', attributes: { 'value': /^(singular|plural|dual)$/ } });
        /*dataFilter.allowElement( 'ref' );
        dataFilter.allowAttributes( { name: 'ref', attributes: { 'target': /^(reference_article|reference_sense)$/ } } );*/
        dataFilter.allowElement('cit');
        dataFilter.allowElement('q');
        dataFilter.allowElement('bibl');
        dataFilter.allowElement('date');
        dataFilter.allowAttributes({ name: 'date', attributes: { 'when': true } });
        dataFilter.allowElement('biblScope');
        dataFilter.allowAttributes({ name: 'biblScope', attributes: { 'type': /^(pp|column|part)$/ } });
    }
}

ClassicEditor
    .create(document.querySelector('#editor'), {
        plugins: [
            Essentials,
            Paragraph,
            SourceEditing,
            TEIAnnotationSupport
        ],
        /*toolbar: [],*/
        htmlSupport: {
            allow: [
                {
                    name: 'author',
                },
                {
                    name: 'persName',
                },
                {
                    name: 'surname',
                },
                {
                    name: 'forename',
                },
                {
                    name: 'placeName',
                },
                {
                    name: 'country',
                    attributes: {
                        key: true,
                    }
                },
                {
                    name: 'region',
                },
                {
                    name: 'settlement',
                },
                {
                    name: 'district',
                },
                {
                    name: 'geogName',
                    attributes: {
                        type: /^(agronym|hydronym|hodonym)$/,
                    }
                },
                {
                    name: 'lang',
                    attributes: {
                        xml: lang: true,
                    }
                },
                {
                    name: 'mentioned',
                    attributes: {
                        type: 'etymon',
                    }
                },
                {
                    name: 'gloss',
                },
                {
                    name: 'etym',
                },
                {
                    name: 'gramGrp',
                },
                {
                    name: 'gram',
                    attributes: {
                        type: 'word_formation',
                    }
                },
                {
                    name: 'm',
                    attributes: {
                        type: /^(bridging_element|word_formation_morpheme|flexion_morpheme|onymic|open|unclear)$/,
                    }
                },
                {
                    name: 'case',
                    attributes: {
                        value: /^(nominative|genetive|dative|accusative|locative|ablative|instrumental|vocative|prepositional)$/,
                    }
                },
                {
                    name: 'number',
                    attributes: {
                        value: /^(singular|plural|dual)$/,
                    }
                },
                {
                    name: 'ref',
                    attributes: {
                        target: /^(reference_article|reference_sense)$/,
                    }
                },
                {
                    name: 'cit',
                },
                {
                    name: 'q',
                },
                {
                    name: 'bibl',
                },
                {
                    name: 'date',
                    attributes: {
                        when: true,
                    }
                },
                {
                    name: 'biblScope',
                    attributes: {
                        type: /^(pp|column|part)$/,
                    }
                },
            ]
        }
    })
    .then(editor => {
        window.editor = editor;
    })
    .catch(err => {
        console.error(err.stack);
    });
