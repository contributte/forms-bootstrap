window.projectVersion = 'master';

(function (root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Czubehead" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead.html">Czubehead</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Czubehead_BootstrapForms" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead/BootstrapForms.html">BootstrapForms</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Czubehead_BootstrapForms_Enums" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead/BootstrapForms/Enums.html">Enums</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Czubehead_BootstrapForms_Enums_DateTimeFormat" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Enums/DateTimeFormat.html">DateTimeFormat</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Enums_RenderMode" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Enums/RenderMode.html">RenderMode</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Enums_RendererConfig" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Enums/RendererConfig.html">RendererConfig</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Enums_RendererOptions" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Enums/RendererOptions.html">RendererOptions</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Czubehead_BootstrapForms_Grid" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead/BootstrapForms/Grid.html">Grid</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Czubehead_BootstrapForms_Grid_BootstrapCell" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Grid/BootstrapCell.html">BootstrapCell</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Grid_BootstrapRow" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Grid/BootstrapRow.html">BootstrapRow</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Czubehead_BootstrapForms_Inputs" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead/BootstrapForms/Inputs.html">Inputs</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Czubehead_BootstrapForms_Inputs_ButtonInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/ButtonInput.html">ButtonInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_CheckboxInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/CheckboxInput.html">CheckboxInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_CheckboxListInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/CheckboxListInput.html">CheckboxListInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_DateTimeInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/DateTimeInput.html">DateTimeInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_IAutocompleteInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html">IAutocompleteInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_IValidationInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/IValidationInput.html">IValidationInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_MultiselectInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/MultiselectInput.html">MultiselectInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_RadioInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/RadioInput.html">RadioInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_SelectInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/SelectInput.html">SelectInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_SubmitButtonInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/SubmitButtonInput.html">SubmitButtonInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_TextAreaInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/TextAreaInput.html">TextAreaInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_TextInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/TextInput.html">TextInput</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Inputs_UploadInput" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Inputs/UploadInput.html">UploadInput</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="namespace:Czubehead_BootstrapForms_Traits" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Czubehead/BootstrapForms/Traits.html">Traits</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Czubehead_BootstrapForms_Traits_AddRowTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/AddRowTrait.html">AddRowTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_BootstrapButtonTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html">BootstrapButtonTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_BootstrapContainerTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html">BootstrapContainerTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_ChoiceInputTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html">ChoiceInputTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_FakeControlTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/FakeControlTrait.html">FakeControlTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_InputPromptTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/InputPromptTrait.html">InputPromptTrait</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_Traits_StandardValidationTrait" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/Traits/StandardValidationTrait.html">StandardValidationTrait</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_BootstrapContainer" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/BootstrapContainer.html">BootstrapContainer</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_BootstrapForm" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/BootstrapForm.html">BootstrapForm</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_BootstrapRenderer" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/BootstrapRenderer.html">BootstrapRenderer</a>                    </div>                </li>                            <li data-name="class:Czubehead_BootstrapForms_BootstrapUtils" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Czubehead/BootstrapForms/BootstrapUtils.html">BootstrapUtils</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning',
    };

    var searchIndex = [

        {
            'type': 'Namespace',
            'link': 'Czubehead.html',
            'name': 'Czubehead',
            'doc': 'Namespace Czubehead',
        }, {
            'type': 'Namespace',
            'link': 'Czubehead/BootstrapForms.html',
            'name': 'Czubehead\\BootstrapForms',
            'doc': 'Namespace Czubehead\\BootstrapForms',
        }, {
            'type': 'Namespace',
            'link': 'Czubehead/BootstrapForms/Enums.html',
            'name': 'Czubehead\\BootstrapForms\\Enums',
            'doc': 'Namespace Czubehead\\BootstrapForms\\Enums',
        }, {
            'type': 'Namespace',
            'link': 'Czubehead/BootstrapForms/Grid.html',
            'name': 'Czubehead\\BootstrapForms\\Grid',
            'doc': 'Namespace Czubehead\\BootstrapForms\\Grid',
        }, {
            'type': 'Namespace',
            'link': 'Czubehead/BootstrapForms/Inputs.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs',
            'doc': 'Namespace Czubehead\\BootstrapForms\\Inputs',
        }, {
            'type': 'Namespace',
            'link': 'Czubehead/BootstrapForms/Traits.html',
            'name': 'Czubehead\\BootstrapForms\\Traits',
            'doc': 'Namespace Czubehead\\BootstrapForms\\Traits',
        },
        {
            'type': 'Interface',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'doc': '&quot;Interface IAutocompleteInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html#method_getAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput::getAutocomplete',
            'doc': '&quot;Gets the state of autocomplete: true=on,false=off,null=omit attribute&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html#method_setAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput::setAutocomplete',
            'doc': '&quot;Turns autocomplete on or off.&quot;',
        },

        {
            'type': 'Interface',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput',
            'doc': '&quot;Classes implementing this interface can explicitly show their validation status.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },


        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms',
            'fromLink': 'Czubehead/BootstrapForms.html',
            'link': 'Czubehead/BootstrapForms/BootstrapContainer.html',
            'name': 'Czubehead\\BootstrapForms\\BootstrapContainer',
            'doc': '&quot;Class BootstrapContainer.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms',
            'fromLink': 'Czubehead/BootstrapForms.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'doc': '&quot;Class BootstrapForm\nForm rendered using Bootstrap 4&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::__construct',
            'doc': '&quot;BootstrapForm constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_getElementPrototype',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::getElementPrototype',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_getRenderer',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::getRenderer',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_setRenderer',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::setRenderer',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_getRenderMode',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::getRenderMode',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_isAjax',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::isAjax',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_isAutoShowValidation',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::isAutoShowValidation',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_setAutoShowValidation',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::setAutoShowValidation',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_isShowValidation',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::isShowValidation',
            'doc': '&quot;If valid fields should explicitly be green&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_setShowValidation',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::setShowValidation',
            'doc': '&quot;If valid fields should explicitly be green&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_setAjax',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::setAjax',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapForm',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapForm.html',
            'link': 'Czubehead/BootstrapForms/BootstrapForm.html#method_setRenderMode',
            'name': 'Czubehead\\BootstrapForms\\BootstrapForm::setRenderMode',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms',
            'fromLink': 'Czubehead/BootstrapForms.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'doc': '&quot;Converts a Form into Bootstrap 4 HTML output.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::__construct',
            'doc': '&quot;BootstrapRenderer constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_attachForm',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::attachForm',
            'doc': '&quot;Sets the form for which to render. Used only if a specific function of the renderer must be executed\noutside of render(), such as during assisted manual rendering.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_configElem',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::configElem',
            'doc': '&quot;Turns configuration or and existing element and configures it appropriately&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_getConfig',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::getConfig',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_getConfigOverride',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::getConfigOverride',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_getGridBreakPoint',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::getGridBreakPoint',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_setGridBreakPoint',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::setGridBreakPoint',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_getMode',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::getMode',
            'doc': '&quot;Returns render mode&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_isGroupHidden',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::isGroupHidden',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_setGroupHidden',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::setGroupHidden',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_render',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::render',
            'doc': '&quot;Provides complete form rendering.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderBegin',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderBegin',
            'doc': '&quot;Renders form begin.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderBody',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderBody',
            'doc': '&quot;Renders form body.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderControl',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderControl',
            'doc': '&quot;Renders &#039;control&#039; part of visual row of controls.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderControls',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderControls',
            'doc': '&quot;Renders group of controls.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderEnd',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderEnd',
            'doc': '&quot;Renders form end.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderLabel',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderLabel',
            'doc': '&quot;Renders &#039;label&#039; part of visual row of controls.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderPair',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderPair',
            'doc': '&quot;Renders single visual row.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_setColumns',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::setColumns',
            'doc': '&quot;Set how many of Bootstrap rows shall the label and control occupy&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_setMode',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::setMode',
            'doc': '&quot;Sets render mode&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_fetchConfig',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::fetchConfig',
            'doc': '&quot;Fetch config tailored for current render mode&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_getElem',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::getElem',
            'doc': '&quot;Get element based on its first-level key&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderDescription',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderDescription',
            'doc': '&quot;Renders control description (help text)&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapRenderer',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapRenderer.html',
            'link': 'Czubehead/BootstrapForms/BootstrapRenderer.html#method_renderFeedback',
            'name': 'Czubehead\\BootstrapForms\\BootstrapRenderer::renderFeedback',
            'doc': '&quot;Renders valid or invalid feedback of form or control&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms',
            'fromLink': 'Czubehead/BootstrapForms.html',
            'link': 'Czubehead/BootstrapForms/BootstrapUtils.html',
            'name': 'Czubehead\\BootstrapForms\\BootstrapUtils',
            'doc': '&quot;Class BootstrapUtils. Utils for this library.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\BootstrapUtils',
            'fromLink': 'Czubehead/BootstrapForms/BootstrapUtils.html',
            'link': 'Czubehead/BootstrapForms/BootstrapUtils.html#method_standardizeClass',
            'name': 'Czubehead\\BootstrapForms\\BootstrapUtils::standardizeClass',
            'doc': '&quot;Converts element classes to an array if needed&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Enums',
            'fromLink': 'Czubehead/BootstrapForms/Enums.html',
            'link': 'Czubehead/BootstrapForms/Enums/DateTimeFormat.html',
            'name': 'Czubehead\\BootstrapForms\\Enums\\DateTimeFormat',
            'doc': '&quot;An easy-to-use list of date\/time formats&lt;\/p&gt;\n\n&lt;h1&gt;How to understand the constants&lt;\/h1&gt;\n\n&lt;ol&gt;\n&lt;li&gt;&lt;code&gt;D_&lt;\/code&gt; prefix -&gt; date format&lt;\/li&gt;\n&lt;li&gt;&lt;code&gt;T_&lt;\/code&gt; prefix -&gt; time format&lt;\/li&gt;\n&lt;li&gt;&lt;code&gt;DMY&lt;\/code&gt;,&lt;code&gt;YMD&lt;\/code&gt; and &lt;code&gt;MDY&lt;\/code&gt; specify the &lt;em&gt;order&lt;\/em&gt; of day, month and year&lt;\/li&gt;\n&lt;li&gt;&lt;code&gt;_NO_LEAD&lt;\/code&gt; suffix means no leading zeros&lt;\/li&gt;\n&lt;li&gt;&lt;code&gt;T_12&lt;\/code&gt; &lt;code&gt;LOWER&lt;\/code&gt;\/&lt;code&gt;UPPER&lt;\/code&gt; point to AM\/am, PM\/pm&lt;\/li&gt;\n&lt;\/ol&gt;\n&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Enums\\DateTimeFormat',
            'fromLink': 'Czubehead/BootstrapForms/Enums/DateTimeFormat.html',
            'link': 'Czubehead/BootstrapForms/Enums/DateTimeFormat.html#method_validate',
            'name': 'Czubehead\\BootstrapForms\\Enums\\DateTimeFormat::validate',
            'doc': '&quot;Checks if give time string is indeed in the format specified.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Enums',
            'fromLink': 'Czubehead/BootstrapForms/Enums.html',
            'link': 'Czubehead/BootstrapForms/Enums/RenderMode.html',
            'name': 'Czubehead\\BootstrapForms\\Enums\\RenderMode',
            'doc': '&quot;Class RenderMode\nDefines the mode BootstrapRenderer works in.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Enums',
            'fromLink': 'Czubehead/BootstrapForms/Enums.html',
            'link': 'Czubehead/BootstrapForms/Enums/RendererConfig.html',
            'name': 'Czubehead\\BootstrapForms\\Enums\\RendererConfig',
            'doc': '&quot;Class RendererConfig.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Enums',
            'fromLink': 'Czubehead/BootstrapForms/Enums.html',
            'link': 'Czubehead/BootstrapForms/Enums/RendererOptions.html',
            'name': 'Czubehead\\BootstrapForms\\Enums\\RendererOptions',
            'doc': '&quot;Class RendererOptions.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Grid',
            'fromLink': 'Czubehead/BootstrapForms/Grid.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'doc': '&quot;Class BootstrapCell.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::__construct',
            'doc': '&quot;BootstrapRow constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method_getElementPrototype',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::getElementPrototype',
            'doc': '&quot;Gets the prototype of this cell so you can define additional attributes. Col-* class is added during\nrendering and is not present, so don&#039;t add it.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method_getNumOfColumns',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::getNumOfColumns',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method_render',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::render',
            'doc': '&quot;Renders the cell into Html object&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method_addComponent',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::addComponent',
            'doc': '&quot;Delegate to underlying component.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapCell.html#method_createClass',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapCell::createClass',
            'doc': '&quot;Creates column class based on numOfColumns&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Grid',
            'fromLink': 'Czubehead/BootstrapForms/Grid.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'doc': '&quot;Class BootstrapRow.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::__construct',
            'doc': '&quot;BootstrapRow constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_addCell',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::addCell',
            'doc': '&quot;Adds a new cell to which a control can be added.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_addComponent',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::addComponent',
            'doc': '&quot;Delegate to underlying container and remember it.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getCells',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getCells',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getElementPrototype',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getElementPrototype',
            'doc': '&quot;The container without content&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getGridBreakPoint',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getGridBreakPoint',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_setGridBreakPoint',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::setGridBreakPoint',
            'doc': '&quot;Sets the xs, sm, md, lg part.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getName',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getName',
            'doc': '&quot;Component name&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getParent',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getParent',
            'doc': '&quot;Returns the container&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_setParent',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::setParent',
            'doc': '&quot;Sets the container&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_getOption',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::getOption',
            'doc': '&quot;Gets previously set option&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_render',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::render',
            'doc': '&quot;Renders the row into a Html object&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow',
            'fromLink': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html',
            'link': 'Czubehead/BootstrapForms/Grid/BootstrapRow.html#method_setOption',
            'name': 'Czubehead\\BootstrapForms\\Grid\\BootstrapRow::setOption',
            'doc': '&quot;Sets option&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/ButtonInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\ButtonInput',
            'doc': '&quot;Class ButtonInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\ButtonInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/ButtonInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/ButtonInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\ButtonInput::__construct',
            'doc': '&quot;ButtonInput constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\ButtonInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/ButtonInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/ButtonInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\ButtonInput::getControl',
            'doc': '&quot;Control HTML&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput',
            'doc': '&quot;Class CheckboxInput. Single checkbox.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput::getControl',
            'doc': '&quot;Generates a checkbox&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html#method_makeCheckbox',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput::makeCheckbox',
            'doc': '&quot;Makes a Bootstrap checkbox HTML&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxListInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxListInput',
            'doc': '&quot;Class CheckboxListInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxListInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/CheckboxListInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxListInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxListInput::getControl',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxListInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/CheckboxListInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/CheckboxListInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\CheckboxListInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'doc': '&quot;Class DateTimeInput. Textual datetime input.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::__construct',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_cleanErrors',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::cleanErrors',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_getValue',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::getValue',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_setValue',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::setValue',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_validate',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::validate',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_getFormat',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::getFormat',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_setFormat',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::setFormat',
            'doc': '&quot;Input accepted format.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/DateTimeInput.html#method_makeFormatPlaceholder',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\DateTimeInput::makeFormatPlaceholder',
            'doc': '&quot;Turns datetime format into a placeholder,  e.g. &#039;d.m.Y&#039; =&gt; &#039;dd.mm.yyyy&#039;.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'doc': '&quot;Interface IAutocompleteInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html#method_getAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput::getAutocomplete',
            'doc': '&quot;Gets the state of autocomplete: true=on,false=off,null=omit attribute&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IAutocompleteInput.html#method_setAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IAutocompleteInput::setAutocomplete',
            'doc': '&quot;Turns autocomplete on or off.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput',
            'doc': '&quot;Classes implementing this interface can explicitly show their validation status.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/IValidationInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\IValidationInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/MultiselectInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\MultiselectInput',
            'doc': '&quot;Class MultiselectInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\MultiselectInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/MultiselectInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/MultiselectInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\MultiselectInput::__construct',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\MultiselectInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/MultiselectInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/MultiselectInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\MultiselectInput::getControl',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/RadioInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput',
            'doc': '&quot;Class RadioInput. Lets user choose one out of multiple options.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/RadioInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/RadioInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput::__construct',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/RadioInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/RadioInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput::getControl',
            'doc': '&quot;Generates control&#039;s HTML element.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/RadioInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/RadioInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\RadioInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/SelectInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\SelectInput',
            'doc': '&quot;Class SelectInput.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\SelectInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/SelectInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/SelectInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\SelectInput::__construct',
            'doc': '&quot;SelectInput constructor.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\SelectInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/SelectInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/SelectInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\SelectInput::getControl',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/SubmitButtonInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\SubmitButtonInput',
            'doc': '&quot;Class SubmitButtonInput. Form can be submitted with this.&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput',
            'doc': '&quot;Class TextAreaInput&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput::__construct',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html#method_getAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput::getAutocomplete',
            'doc': '&quot;Gets the state of autocomplete: true=on,false=off,null=omit attribute&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html#method_setAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput::setAutocomplete',
            'doc': '&quot;Turns autocomplete on or off.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextAreaInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextAreaInput::getControl',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'doc': '&quot;Class TextInput&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method___construct',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::__construct',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method_getAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::getAutocomplete',
            'doc': '&quot;Gets the state of autocomplete: true=on,false=off,null=omit attribute&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method_setAutocomplete',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::setAutocomplete',
            'doc': '&quot;Turns autocomplete on or off.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::getControl',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method_getPlaceholder',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::getPlaceholder',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\TextInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/TextInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/TextInput.html#method_setPlaceholder',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\TextInput::setPlaceholder',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Class',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs',
            'fromLink': 'Czubehead/BootstrapForms/Inputs.html',
            'link': 'Czubehead/BootstrapForms/Inputs/UploadInput.html',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput',
            'doc': '&quot;Class UploadInput. Single or multi upload of files.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/UploadInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/UploadInput.html#method_getButtonCaption',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput::getButtonCaption',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/UploadInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/UploadInput.html#method_setButtonCaption',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput::setButtonCaption',
            'doc': '&quot;the text on the left part of the button&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/UploadInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/UploadInput.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput::getControl',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput',
            'fromLink': 'Czubehead/BootstrapForms/Inputs/UploadInput.html',
            'link': 'Czubehead/BootstrapForms/Inputs/UploadInput.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Inputs\\UploadInput::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/AddRowTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\AddRowTrait',
            'doc': '&quot;Trait AddRowTrait. Implements method to add a bootstrap row.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\AddRowTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/AddRowTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/AddRowTrait.html#method_addRow',
            'name': 'Czubehead\\BootstrapForms\\Traits\\AddRowTrait::addRow',
            'doc': '&quot;Adds a new Grid system row.&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait',
            'doc': '&quot;Trait BootstrapButtonTrait. Modifies an existing button class such that it returns a bootstrap button.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html#method_getBtnClass',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait::getBtnClass',
            'doc': '&quot;Gets additional button class. Default is btn-primary.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html#method_setBtnClass',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait::setBtnClass',
            'doc': '&quot;Sets additional button class. Default is btn-primary&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html#method_getControl',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait::getControl',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapButtonTrait.html#method_addBtnClass',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapButtonTrait::addBtnClass',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'doc': '&quot;Trait BootstrapContainerTrait.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addButton',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addButton',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addCheckbox',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addCheckbox',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addCheckboxList',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addCheckboxList',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addComponent',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addComponent',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addContainer',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addContainer',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addDateTime',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addDateTime',
            'doc': '&quot;Adds a datetime input.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addEmail',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addEmail',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addInputError',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addInputError',
            'doc': '&quot;Adds error to a specific component&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addInteger',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addInteger',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addMultiSelect',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addMultiSelect',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addMultiUpload',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addMultiUpload',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addPassword',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addPassword',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addRadioList',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addRadioList',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addSelect',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addSelect',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addSubmit',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addSubmit',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addText',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addText',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addTextArea',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addTextArea',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/BootstrapContainerTrait.html#method_addUpload',
            'name': 'Czubehead\\BootstrapForms\\Traits\\BootstrapContainerTrait::addUpload',
            'doc': '&quot;&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'doc': '&quot;Trait ChoiceInputTrait.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_flatAssocArray',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::flatAssocArray',
            'doc': '&quot;Processes an associative array in a way that it has no nesting. Keys for\nnested arrays are lost, but nested arrays are merged.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_makeOptionList',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::makeOptionList',
            'doc': '&quot;Makes array of &amp;lt;option&amp;gt;. Can handle associative arrays just fine. Checks for duplicate values.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_setItems',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::setItems',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_isControlDisabled',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::isControlDisabled',
            'doc': '&quot;Check if whole control is disabled.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_isValueDisabled',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::isValueDisabled',
            'doc': '&quot;Check if a specific value is disabled. If whole control is disabled, returns false.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/ChoiceInputTrait.html#method_isValueSelected',
            'name': 'Czubehead\\BootstrapForms\\Traits\\ChoiceInputTrait::isValueSelected',
            'doc': '&quot;Self-explanatory&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'doc': '&quot;Trait FakeControlTrait.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_getErrors',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::getErrors',
            'doc': '&quot;Always returns an empty array&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_getValue',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::getValue',
            'doc': '&quot;Not supported&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_isDisabled',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::isDisabled',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_isOmitted',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::isOmitted',
            'doc': '&quot;Is control value excluded from $form-&gt;getValues() result?&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_setValue',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::setValue',
            'doc': '&quot;Not supported&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/FakeControlTrait.html#method_validate',
            'name': 'Czubehead\\BootstrapForms\\Traits\\FakeControlTrait::validate',
            'doc': '&quot;Do nothing&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/InputPromptTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\InputPromptTrait',
            'doc': '&quot;Trait InputPromptTrait.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\InputPromptTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/InputPromptTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/InputPromptTrait.html#method_getPrompt',
            'name': 'Czubehead\\BootstrapForms\\Traits\\InputPromptTrait::getPrompt',
            'doc': '&quot;&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\InputPromptTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/InputPromptTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/InputPromptTrait.html#method_setPrompt',
            'name': 'Czubehead\\BootstrapForms\\Traits\\InputPromptTrait::setPrompt',
            'doc': '&quot;Sets the first unselectable item on list. Its value is null.&quot;',
        },

        {
            'type': 'Trait',
            'fromName': 'Czubehead\\BootstrapForms\\Traits',
            'fromLink': 'Czubehead/BootstrapForms/Traits.html',
            'link': 'Czubehead/BootstrapForms/Traits/StandardValidationTrait.html',
            'name': 'Czubehead\\BootstrapForms\\Traits\\StandardValidationTrait',
            'doc': '&quot;Trait StandardValidationTrait.&quot;',
        },
        {
            'type': 'Method',
            'fromName': 'Czubehead\\BootstrapForms\\Traits\\StandardValidationTrait',
            'fromLink': 'Czubehead/BootstrapForms/Traits/StandardValidationTrait.html',
            'link': 'Czubehead/BootstrapForms/Traits/StandardValidationTrait.html#method_showValidation',
            'name': 'Czubehead\\BootstrapForms\\Traits\\StandardValidationTrait::showValidation',
            'doc': '&quot;Modify control in such a way that it explicitly shows its validation state.&quot;',
        },


        // Fix trailing commas in the index
        {},
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term)
    {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        }
        else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0, -1));

        return tokens;
    }

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function (term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function (term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function (matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function (ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function (type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function (ele) {
            ele.html(treeHtml);
        },
    };

    $(function () {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function () {

    // Enable the version switcher
    $('#version-switcher').change(function () {
        window.location = $(this).val();
    });


    // Toggle left-nav divs on click
    $('#api-tree .hd span').click(function () {
        $(this).parent().parent().toggleClass('opened');
    });

    // Expand the parent namespaces of the current page.
    var expected = $('body').attr('data-name');

    if (expected) {
        // Open the currently selected node and its parents.
        var container = $('#api-tree');
        var node = $('#api-tree li[data-name="' + expected + '"]');
        // Node might not be found when simulating namespaces
        if (node.length > 0) {
            node.addClass('active').addClass('opened');
            node.parents('li').addClass('opened');
            var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
            // Position the item nearer to the top of the screen.
            scrollPos -= 200;
            container.scrollTop(scrollPos);
        }
    }


    var form = $('#search-form .typeahead');
    form.typeahead({
        hint: true,
        highlight: true,
        minLength: 1,
    }, {
        name: 'search',
        displayKey: 'name',
        source: function (q, cb) {
            cb(Sami.search(q));
        },
    });

    // The selection is direct-linked when the user selects a suggestion.
    form.on('typeahead:selected', function (e, suggestion) {
        window.location = suggestion.link;
    });

    // The form is submitted when the user hits enter.
    form.keypress(function (e) {
        if (e.which == 13) {
            $('#search-form').submit();
            return true;
        }
    });


});


