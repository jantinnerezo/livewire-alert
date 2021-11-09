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
        Livewire.emit(interaction.onConfirmed, interaction.result);
        
        return;
    }

    if (interaction.isDenied) {
        Livewire.emit(interaction.onDenied, interaction.result);

        return;
    }

    if (
        interaction.onProgressFinished &&
        interaction.dismiss === Swal.DismissReason.timer
    ) {
        Livewire.emit(interaction.onProgressFinished, interaction.result);

        return;
    }

    if (interaction.onDismissed) {
        Livewire.emit(interaction.onDismissed, interaction.result);
    }
}