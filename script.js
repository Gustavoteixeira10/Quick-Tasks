const chk = document.getElementById('chk')

if(localStorage.getItem("tema") == undefined){
    localStorage.setItem("tema", "claro")
}
let tema = localStorage.getItem("tema")

chk.addEventListener('change', () => { 
    if(tema == "claro"){
        document.body.classList.add('dark')
        localStorage.setItem("tema", "escuro")
    }else{
        document.body.classList.remove('dark')
        localStorage.setItem("tema", "claro")
    }
    tema = localStorage.getItem("tema")
})




if(tema == "claro"){
    document.body.classList.remove('dark')
    console.log("Tema claro")
    console.log(tema)
}else{
    document.body.classList.add('dark')
    console.log("Tema escuro")
}


// Função para formatar a data
function formatarData(input) {
    // Formato esperado: dd/mm/aaaa
    var valor = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    var dia = valor.substring(0, 2);
    var mes = valor.substring(2, 4);
    var ano = valor.substring(4, 8);

    // Verifica se o tamanho do valor é maior que 4 e menor que 8
    if (valor.length > 4) {
        input.value = dia + '/' + mes + '/' + ano;
    } else if (valor.length > 2) {
        input.value = dia + '/' + mes;
    }
}



// Adiciona um listener para o evento de digitação no campo de data
//  document.getElementById('data').addEventListener('input', function () {
//     formatarData(this);
// });


