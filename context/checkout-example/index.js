Paddle.Environment.set("sandbox");
Paddle.Initialize({
  token: "test_7d279f61a3499fed520f7cd8c08", // replace with a client-side token
  // prints events to console for debugging
  eventCallback: function(data) {
    console.log(data);
  }
});

// define items
let itemsList = [
    {
      priceId: 'pri_01gsz8x8sawmvhz1pv30nge1ke',
      quantity: 10
    },
    {
      priceId: 'pri_01gsz98e27ak2tyhexptwc58yk',
      quantity: 1
    }
];

// define customer details
let customerInfo = {
  email: "sam@example.com",
  address: {
    countryCode: "US",
    postalCode: "10021"
  }
};

// open checkout
function openCheckout(items, customer) {
  Paddle.Checkout.open({
    items: items,
    customer: customer
  });
}
