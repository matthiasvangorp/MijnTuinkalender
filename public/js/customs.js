/**
 * 
 */
function setUpCK() {
	if(document.getElementById('beschrijving')) {
        var oFCKeditor = new CKeditor('beschrijving') ;
        oFCKeditor.BasePath = "/js/fckeditor/" ;
        oFCKeditor.Height = 400;
        oFCKeditor.ReplaceTextarea() ;
    }

}