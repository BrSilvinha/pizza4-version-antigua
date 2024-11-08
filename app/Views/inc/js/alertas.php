<script>
  function confirmDelete(productId) {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción eliminará el producto de forma permanente.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirigir a la URL de eliminación si se confirma
        window.location.href = "/PIZZA4/public/productos/delete/" + productId;
      }
    });
  }
  // const form = document.querySelector('form');

  // form.addEventListener('submit', function(event) {
  //   event.preventDefault(); // Prevenir el envío del formulario

  //   Swal.fire({
  //     title: '¿Estás seguro?',
  //     text: 'Se guardarán los cambios realizados.',
  //     icon: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: 'Sí, guardar',
  //     cancelButtonText: 'Cancelar'
  //   }).then((result) => {
  //     if (result.isConfirmed) {
  //       // Enviar el formulario si se confirma
  //       form.submit();
  //     }
  //   });
  // });
</script>