'use strict'
app.factory('$export2PdfProvider', [ '$filter', '$rootScope' ,function ($filter, $rootScope) {

     return {
         a4: [ 595.28,  841.89],
         export :  function (htmlElement, fileName) {
             var element2Export = angular.element(document.querySelector('#'+htmlElement));
             //var element2Export = $('#'+htmlElement);
             var cache_width = element2Export.width();
             $('body').scrollTop(0);
             this.createPdf(element2Export, cache_width, fileName);

         },

         createPdf : function (DomElement, cache_width, fileName) {
             this.getCanvas(DomElement).then(function(canvas){
             //var canvas = this.getCanvas(DomElement);
                 console.log(fileName);
                 console.log(canvas);
                 var
                     img = canvas.toDataURL("image/png"),
                     doc = new jsPDF({
                         unit:'px',
                         format:'a4'
                     });
                 doc.addImage(img, 'JPEG', 20, 20);
                 doc.save(fileName+ '.pdf');
                 DomElement.width(cache_width);
             });
         },
         
         getCanvas : function (DomElement) {
             DomElement.width((this.a4[0]*1.33333) -80).css('max-width','none');
             return  html2canvas(DomElement,{
                 imageTimeout:2000,
                 removeContainer:true
             });
         }
     }
}]);