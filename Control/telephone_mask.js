function telephoneMask(inputElementId) {
    var telefone = document.getElementById(inputElementId);

    telefone.addEventListener("input", () => {
        var limpar = telefone.value.replace(/\D/g, "").substring(0, 11);
        telefone.value = limpar;

        var numeros = limpar.split("");
        var numeroFormatado = "";

        if (numeros.length > 0) {
            numeroFormatado += `(${numeros.slice(0, 2).join("")})`;
        }

        if (numeros.length > 2) {
            numeroFormatado += ` ${numeros.slice(2, 7).join("")}`;
        }

        if (numeros.length > 7) {
            numeroFormatado += `-${numeros.slice(7, 11).join("")}`;
        }
        telefone.value = numeroFormatado;
    });
}
