<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
window.addEventListener('alert',event=>{const type=event.detail.type ?? null;const options={position:'top-end',timer:3000,toast:true,title:event.detail.message ?? '',text:null,showCancelButton:false,showConfirmButton:false,...event.detail.options};Swal.fire({...options,icon:type})})
</script>