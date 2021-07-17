(()=>{
    /*---------------
    #Variable
    ----------------*/
    const inputFiltro = document.querySelector('#filtro');
    const tabla= document.querySelectorAll('.fila-post');
    const btnExportar = document.querySelector("#btnExportar")




    //Eventos del dom
    const eventosDom = ()=>{
        inputFiltro.addEventListener('keyup', e=> filtrarPost(e))
        btnExportar.addEventListener('click', e => exportarExel(e))

    }


    //Funciones
    const filtrarPost = (e)=>{
       // e.target.value
       tabla.forEach(el => {
           el.textContent.toLowerCase().includes(e.target.value) 
            ? el.classList.remove('filter')
            : el.classList.add('filter')

       });
    }

    const exportarExel = (e)=>{
        e.preventDefault();
        const $tabla = document.querySelector("#tablaPosts");

        let tableExport = new TableExport($tabla, {
            exportButtons: false, // No queremos botones
            filename: "Lista de Post", //Nombre del archivo de Excel
            sheetname: "posts", //Título de la hoja
        });
        let datos = tableExport.getExportData();
    
        let preferenciasDocumento = datos.tablaPosts.xlsx;
        tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
    }



    eventosDom()


})()


