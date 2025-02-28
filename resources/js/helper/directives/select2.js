//
// app.directive('select2', {
//     twoWay: true,
//     bind: function () {
//         var optionsData
//         var optionsExpression = this.el.getAttribute('options')
//         if (optionsExpression) {
//             optionsData = this.vm.$eval(optionsExpression)
//         }
//         var self = this
//         $(this.el).select2({
//             data: optionsData
//         }).on('change', function () {
//             self.set(this.value)
//         })
//     },
//
//     update: function (value) {
//         $(this.el).val(value).trigger('change')
//     },
//
//     unbind: function () {
//         $(this.el).off().select2('destroy')
//     }
// })
