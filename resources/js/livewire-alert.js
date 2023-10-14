/** Alert event listener */
window.addEventListener('alert', async (event) => {
    var message = event.detail.message;
    var icon = event.detail.type ?? null;
    var data = event.detail.data;
    var events = event.detail.events;
    var options = event.detail.options;
    evalCallbacksOptions(options);
    var alert = await Swal.fire({
        title: message,
        icon: icon,
        ...options
    }); 

    afterAlertInteraction({
        confirmed: alert.isConfirmed,
        denied: alert.isDenied,
        dismiss: alert.dismiss,
        result: {
            ...alert,
            data: {
                ...data,
                inputAttributes: options.inputAttributes ?? null
            }
        },
        ...events,
        ...alert,
        ...options
    })
});

window.flashAlert = async (flash) => {
    var events = flash.events;
    var data = flash.events.data;
    var options = flash.options;
    evalCallbacksOptions(options);
    var flashAlert = await Swal.fire({
        title: flash.message ?? '',
        icon: flash.type ?? null,
        ...options
    }) 

    afterAlertInteraction({
        confirmed: flashAlert.isConfirmed,
        denied: flashAlert.isDenied,
        dismiss: flashAlert.dismiss,
        result: {
            ...flashAlert,
            data: {
                ...data,
                inputAttributes: options.inputAttributes ?? null
            }
        },
        ...events,
        ...flash.options
    })
}

function evalCallbacksOptions(options) {
    const callbacksKeysAllowed = [
        'allowOutsideClick',
        'allowEscapeKey',
        'allowEnterKey',
        'loaderHtml',
        'inputOptions',
        'inputValidator',
        'preConfirm',
        'preDeny',
        'didClose',
        'didDestroy',
        'didOpen',
        'didRender',
        'willClose',
        'willOpen',
    ];
    for (var callbackKey of callbacksKeysAllowed) {
        if (options.hasOwnProperty(callbackKey) && (typeof options[callbackKey] === 'string' || options[callbackKey] instanceof String)) {
            if (options[callbackKey] && options[callbackKey].trim()!='') {
                 options[callbackKey] = eval(options[callbackKey]);
            }
        }
    }
}

function afterAlertInteraction(interaction) {
    if (interaction.confirmed) {
        if (interaction.onConfirmed.component === 'self') {
            Livewire.find(interaction.onConfirmed.id)
                .dispatchSelf(interaction.onConfirmed.listener, interaction.result);

            return;
        } 

        Livewire.dispatchTo(
            interaction.onConfirmed.component,
            interaction.onConfirmed.listener,
            interaction.result
        );

        return;
    }

    if (interaction.isDenied) {
        if (interaction.onDenied.component === 'self') {
            Livewire.find(interaction.onDenied.id)
                .dispatchSelf(interaction.onDenied.listener, interaction.result);

            return;
        }

        Livewire.dispatchTo(
            interaction.onDenied.component,
            interaction.onDenied.listener,
            interaction.result
        );

        return;
    }

    if (
        interaction.onProgressFinished &&
        interaction.dismiss === Swal.DismissReason.timer
    ) {
        if (interaction.onProgressFinished.component === 'self') {
            Livewire.find(interaction.onProgressFinished.id)
                .dispatchSelf(interaction.onProgressFinished.listener, interaction.result);

            return;
        }

        Livewire.dispatchTo(
            interaction.onProgressFinished.component,
            interaction.onProgressFinished.listener,
            interaction.result
        );

        return;
    }

    if (interaction.onDismissed) {
        if (interaction.onDismissed.component === 'self') {
            Livewire.find(interaction.onDismissed.id)
                .dispatch(interaction.onDismissed.listener, interaction.result);
            
            return;
        } 

        Livewire.dispatchTo(
            interaction.onDismissed.component,
            interaction.onDismissed.listener,
            interaction.result
        );
    }
}