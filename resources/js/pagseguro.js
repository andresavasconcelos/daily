const pagSeguro = {
    creditCards: {},
    getBrand: function(bin){
        return new Promise(function(resolve, reject){
            PagSeguroDirectPayment.getBrand({
                cardBin: bin,
                success: function(response){
                    resolve({
                        result: response,
                        url: 'https://stc.pagseguro.uol.com.br/'
                    });
                }
            })
        });
    },
    getInstallments: function(amount, brand){
        return new Promise(function (resolve, reject) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (response) {
                    resolve({
                        result: response
                    });
                }
            });
        })
    },
    getPaymentMethod: function(amount){
        return new Promise(function(resolve, reject){
            console.log(amount);
            PagSeguroDirectPayment.getPaymentMethods({
                amount: amount,
                success: function(response){
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
                }
            })
        });
    },
    getSenderHash: function () {
        return new Promise(function(resolve, reject){
           var data = PagSeguroDirectPayment.getSenderHash();
           resolve(data);
        });
    }
};
