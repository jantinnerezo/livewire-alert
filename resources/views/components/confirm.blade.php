@props(['onConfirmed','onCancelled' => null])
<div 
    x-data="" 
    @confirming.window="
        const options = {title:$event.detail.title,text:null,icon:'warning',showCancelButton:true,confirmButtonColor:'#3085d6',cancelButtonColor:'#d33',confirmButtonText:$event.detail.confirmButtonText ?? 'Yes',...$event.detail.options};
        Swal.fire(options).then((result) => {
            if (result.isConfirmed) { @this.call('{!! $onConfirmed !!}'); } 
            else { const cancelCallback = '{!! $onCancelled !!}'; if (!cancelCallback) { return; } @this.call(cancelCallback) }
        })
    "
    wire:ignore
>
</div>