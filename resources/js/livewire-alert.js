/** Alert event listener */
window.addEventListener('alert', async (event) => {
    var message = event.detail.message;
    var icon = event.detail.type ?? null;
    var data = event.detail.data;
    var events = event.detail.events;
    var options = event.detail.options;
    
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
    var flashAlert = await Swal.fire({
        title: flash.message ?? '',
        icon: flash.type ?? null,
        ...flash.options
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

function afterAlertInteraction(interaction) {
    if (interaction.confirmed) {
        if (interaction.onConfirmed.component === 'self') {
            Livewire.find(interaction.onConfirmed.id)
                .emitSelf(interaction.onConfirmed.listener, interaction.result);

            return;
        } 

        Livewire.emitTo(
            interaction.onConfirmed.component,
            interaction.onConfirmed.listener,
            interaction.result
        );

        return;
    }

    if (interaction.isDenied) {
        if (interaction.onDenied.component === 'self') {
            Livewire.find(interaction.onDenied.id)
                .emitSelf(interaction.onDenied.listener, interaction.result);

            return;
        }

        Livewire.emitTo(
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
                .emitSelf(interaction.onProgressFinished.listener, interaction.result);

            return;
        }

        Livewire.emitTo(
            interaction.onProgressFinished.component,
            interaction.onProgressFinished.listener,
            interaction.result
        );

        return;
    }

    if (interaction.onDismissed) {
        if (interaction.onDismissed.component === 'self') {
            Livewire.find(interaction.onDismissed.id)
                .emit(interaction.onDismissed.listener, interaction.result);
            
            return;
        } 

        Livewire.emitTo(
            interaction.onDismissed.component,
            interaction.onDismissed.listener,
            interaction.result
        );
    }
}