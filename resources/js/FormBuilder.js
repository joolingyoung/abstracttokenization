class FormBuilder {
    constructor( form_body ) {
        if( !form_body ) {
            console.error( 'No form body set.' );
        }

        this.form = this.addPreviewStep(form_body);
        this.step = 1;
        this.state = { };

        // Register our autosave function for every 30 seconds
        setTimeout( () => { this.autosave() }, 30 * 1000 );
    }

    get header() {
        return this.form.steps[this.stepIndex].header;
    }

    get description() {
        return this.form.steps[this.stepIndex].desc;
    }

    get currentStep() {
        return this.step;
    }

    get totalSteps() {
        return this.form.steps.length;
    }

    get stepIndex() {
        return this.step - 1;
    }

    nextStep() {
        this.step += 1;
    }

    addPreviewStep( form_data ) {
        const previewInfo = {
            header: 'Confirm',
            desc: 'Before we submit, please double check all of the information that\'s included below. Any changes you make will be saved when you submit.'
        }

        form_data.steps.push( previewInfo );
        return form_data;
    }

    buildBodyFromStepRoot( createElement ) {
        // Remember that our last "step" is actually a preview.
        if( this.stepIndex < ( this.form.steps.length - 1 ) ) {
            return this.generateBody( this.form.steps[this.stepIndex].body, createElement );
        } else {
            return this.renderPreview( this.form.steps, createElement );
        }
    }

    generateBody( root, createElement ) {
        const elements = root.map( el => {
            return this.getComponent( el, createElement );
        } );

        return createElement( 'div', { class: 'row' }, elements );
    }

    autosave() {
        console.log( this.state );

        // Reregister autosave...
        setTimeout( () => { this.autosave() }, 30 * 1000 );
    }

    getComponent( fieldInfo, createElement ) {
        // Map the component to the appropriate element
        let el;
        switch( fieldInfo.type ) {
            case 'pane':
                el = 'Pane';
                break;
            case 'upload':
                el = 'SingleImageUpload';
                break;
            case 'row':
                el = 'Row';
                break;
            case 'text':
                el = 'TextField';
                break;
            case 'email':
                el = 'EmailField';
                break;
            case 'heading':
                el = 'Heading';
                break;
            case 'paragraph':
                el = 'Paragraph';
                break;
            case 'textarea':
                el = 'Textarea';
                break;
            default:
                el = 'UnknownComponent';
                break;
        }

        // Build the list of props that we want to pass to the component, omitting children ("fields")
        const propList = Object.keys( fieldInfo );
        const props = {};
        propList.forEach( prop => {
          if( prop != 'fields' ) {
            props[prop] = fieldInfo[prop];
          }  
        } );

        // Set a list of empty children to simplify evaluation later, if needed
        fieldInfo.fields = typeof( fieldInfo.fields ) == 'undefined' ? [] : fieldInfo.fields;

        // Render the given element
        return createElement( el,
          {
              props: props
          },
          fieldInfo.fields.map( field => this.getComponent( field, createElement ) )
        );
    }

    renderPreview( steps, createElement ) {
        let stepBodies = [];

        // Remove the preview step, so we don't accidentally recurse
        steps.pop();

        steps.forEach( step => {
            stepBodies.push( createElement( 'row', { class: 'col-md-12' }, [
                createElement( 'h1', step.header ),
                createElement( 'row', { class: 'col-md-12' }, [ this.generateBody( step.body, createElement ) ] ),
            ] ) ) 
        } );

        return createElement( 'row', {}, stepBodies );
    }

    doFieldUpdate(fieldName, event) {
        event.preventDefault();
        this.state[ fieldName ] = event.target.value;
    }

}

module.exports = FormBuilder;