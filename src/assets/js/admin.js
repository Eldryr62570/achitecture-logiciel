
allEditButton.forEach((button) => {
    button.addEventListener('click' , () =>{
      showModal("sample-modal2" , 'Modifier un utilisateur')
        actionInput.value = "changeUser"
        idUserInput.value= button.dataset.idUser
    })
})