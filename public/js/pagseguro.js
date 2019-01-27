var pagSeguro = {
    creditCards: {},
    getBrand: function getBrand(bin) {
        return new Promise(function (resolve, reject) {
            PagSeguroDirectPayment.getBrand({
                cardBin: bin,
                success: function success(response) {
                    resolve({
                        result: response,
                        url: 'https://stc.pagseguro.uol.com.br/'
                    });
                }
            });
        });
    },
    getInstallments: function getInstallments(amount, brand) {
        return new Promise(function (resolve, reject) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function success(response) {
                    resolve({
                        result: response
                    });
                }
            });
        });
    },
    getPaymentMethod: function getPaymentMethod(amount) {
        return new Promise(function (resolve, reject) {
            PagSeguroDirectPayment.getPaymentMethods({
                amount: amount,
                success: function success(response) {
                    var creditCards = pagSeguro.creditCards = response.paymentMethods.CREDIT_CARD.options;
                    var brandsUrls = [];
                    var prefix = 'https://stc.pagseguro.uol.com.br';

                    // for(var brand in brands){
                    //
                    //     if(brands[brand].status === "AVAILABLE"){
                    //         var url = brands[brand].images.MEDIUM.path;
                    //
                    //         brandsUrls.push(prefix + url);
                    //     }
                    //
                    // }

                    resolve(creditCards);
                },
                error: function error(e){
                    console.log(e);
                }
            });
        });
    },
    getSenderHash: function getSenderHash() {
        return new Promise(function (resolve, reject) {
            var data = PagSeguroDirectPayment.getSenderHash();
            resolve(data);
        });
    }
};