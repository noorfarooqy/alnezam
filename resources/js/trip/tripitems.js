require ("../bootstrap");

var app = new Vue({
    el: "#app",
    data: {
        Client: {
            client_name: null,
            client_email:null,
            client_phone: null,
            client_location: 1,
            client_mark: null,
            
        },
        ClientList: [],
        Server: new Server(),
        Error: new Error(),
        Success: new Success(),
        ItemDetails: {
            item_name:null,
            item_quantity: 0,
            item_price: 0,
            item_total_aed: 0,
            item_total_usd : 0,
            item_paid : 0,
            client_mark:null,
            client_name:"Select client mark",
            trip_id: window.trip_id,
            resetItemDetails: function(item)
            {
                item = {
                    item_name:null,
                    item_quantity: 0,
                    item_price: 0,
                    item_total_aed: 0,
                    item_total_usd : 0,
                    item_paid : 0,
                    client_mark:null,
                    client_name:"Select client mark",
                    trip_id: window.trip_id,
                }
            }
            
        },
        grand_total_aed: 0,
        grand_total_usd: 0,
        ItemList: []
    },
    computed: {
        
        totalAED: function()
        {
            this.ItemDetails.item_total_aed = (this.ItemDetails.item_price * this.ItemDetails.item_quantity);
            this.ItemList.item_total_aed = this.ItemDetails.item_total_aed.toFixed(4);
            return "AED "+this.ItemDetails.item_total_aed;
        },
        totalUSD : function ()
        {
            this.ItemDetails.item_total_usd = (this.ItemDetails.item_total_aed / 3.67).toFixed(4);
            return "USD "+this.ItemDetails.item_total_usd;
        },
    },
    mounted() {
        this.getClientList();
        $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").on('switchChange.bootstrapSwitch', 
            this.setPaymentStatus.bind(this)
        );
        this.getItemList();
        
    },
    filters: {

    },
    methods: {

        getGrandTotal(priceaed, priceusd) {
            this.grand_total_aed += priceaed;
            this.grand_total_usd += priceusd;
        },
        getItemList()
        {
            this.Server.setRequest({'trip_id': this.ItemDetails.trip_id});
            this.Server.serverRequest('/items/list', this.setItemList, this.showError);
        },
        setItemList(data)
        {
            // console.log('data ',data);
            this.ItemList = data[0];
            this.grand_total_usd = data[1].grand_usd;
            this.grand_total_aed = data[1].grand_aed;
            this.resetModals();

        },
        addItem()
        {
            this.resetModals();
            this.Server.setRequest(this.ItemDetails);
            this.Server.serverRequest('/items/new', this.addedNewItem, this.showError);
        },
        addedNewItem(data)
        {
            console.log('data ',data);
            this.ItemList.push(data[0]);
            this.grand_total_usd = data[1].grand_usd;
            this.grand_total_aed = data[1].grand_aed;
            this.showSuccess('Successfully added item ',data[0].item_name);
            var self = this;
            this.ItemDetails.resetItemDetails(this.ItemDetails);
            setTimeout(function(){
                self.resetModals();
            },5000)
            $(".bt-switch input#paidCheck, .bt-switch input[type='radio']").bootstrapSwitch();
        },
        setPaymentStatus(event,state)
        {
            this.ItemDetails.item_paid = state;
        },
        getClientList()
        {
            this.Server.setRequest({ });
            this.Server.serverRequest('/clients/list', this.setClientList, this.showError);
        },
        setClientList(data)
        {
            this.ClientList = data;
        },
        SelectClientLocation(event)
        {
            console.log('event is ',event);
            var index = event.target.value;
            this.Client.client_location = index;

        },
        SelectedItemClient(event)
        {
            var index = event.target.selectedIndex;
            if(index === 0)
                this.ItemDetails.client_name = "Select client mark"
            else
            {
                this.ClientList.forEach(client => {
                    var mark = event.target.selectedOptions[0].text;
                    if(client.client_mark === mark)
                    this.ItemDetails.client_name = client.client_name;
                });
            }
            this.ItemDetails.client_mark = event.target.value
        },
        AddNewClient()
        {
            this.resetModals();
            this.Server.setRequest(this.Client);
            this.Server.serverRequest('/clients/new', this.ClientAdded, this.showError);
        },
        ClientAdded(data)
        {
            this.ClientList.push(data);
            this.showSuccess('Successfully added new client '+data.client_name);
        },
        showError(error)
        {
            this.Error.showErrorModal(error);
        },
        showSuccess(success_text)
        {
            this.Success.showSuccessModal(success_text);
        },
        resetModals()
        {
            this.Error.resetErrorModal()
            this.Success.resetSuccessModal()
        }

    }
})