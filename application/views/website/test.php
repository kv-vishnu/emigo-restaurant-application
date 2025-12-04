 <button type="button" id="send-order" >Send</button>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
        $(document).ready(function () {
            $('#send-order').on('click', function () {
                // Order details
                
                let orderDetails = {
                    name: "John Doe",
                    items: [
                        { name: "Burger", quantity: 2, price: 5.99 },
                        { name: "Fries", quantity: 1, price: 2.99 },
                    ],
                    total: 14.97,
                };

                // Construct message
                let message = `Order Details:\nName: ${orderDetails.name}\n\nItems:\n`;
                orderDetails.items.forEach((item, index) => {
                    message += `${index + 1}. ${item.name} (x${item.quantity}) - $${item.price.toFixed(2)}\n`;
                });
                message += `\nTotal: $${orderDetails.total.toFixed(2)}`;

                const whatsappNumber = "919995205444";

                // Encode message
                const encodedMessage = encodeURIComponent(message);

                // Open WhatsApp URL
                const whatsappURL = `https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodedMessage}`;
                //const whatsappURL = `https://api.whatsapp.com/send?phone=7012713312&text=Hello`;

                
                // Use `location.href` as a fallback for `window.open`
                try {
                    window.open(whatsappURL, '_blank');
                } catch (error) {
                    console.error("Popup blocked. Redirecting directly...");
                    window.location.href = whatsappURL;
                }
            });
        });
    </script>