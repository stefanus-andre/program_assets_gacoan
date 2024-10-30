document.addEventListener('DOMContentLoaded', function(){
    function generateRandomCode(length) {
      return Math.floor(Math.pow(10, length-1) + Math.random() * 9 * Math.pow(10, length - 1));
    }

    function generateAssetCode() {
      const date = new Date();
      const day = String(date.getDate()).padStart(2, '0');
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const year = date.getFullYear();
      const randomCode = generateRandomCode(4);

      const assetCode = `AST-${day}-${month}-${year}-${randomCode}`;
      return assetCode;
    }

    function newSetAssetCode() {
      document.getElementById('asset_code').value =generateAssetCode();
    }

    newSetAssetCode();
  });