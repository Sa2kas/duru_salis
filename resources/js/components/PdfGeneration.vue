<template>
    <div class="pdf">
        <button class="generate-pdf" @click="getNumberOfPages">
            generuoti pdf
        </button>
        kkk {{number}}
    </div>
</template>
<script>
// import jsPDFInvoiceTemplate from "jspdf-invoice-template";
// import jsPDFInvoiceTemplate, { OutputType, jsPDF } from "jspdf-invoice-template";
import emailjs from 'emailjs-com';
export default {
    data () {
        return {
            order_id: "D20220506",
            to_name: "Gerb. kažkas",
            receiver: "vigaile.zygaite@gmail.com",
            number: 0,
            props: {
                // outputType: OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "Invoice 2021",
                orientationLandscape: false,
                compress: true,
                logo: {
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/logo.png",
                    width: 53.33, //aspect ratio = width/height
                    height: 26.66,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "Durų šalis",
                    address: "Žiemgalių g. 8, Kaunas LT-48230, Lietuva",
                    phone: "+37061603034",
                    email: "info@durusalis.lt",
                    website: "	o7il.l.durusalis.lt",
                },
                contact: {
                    label: "Invoice issued for:",
                    name: "Client Name",
                    address: "Albania, Tirane, Astir",
                    phone: "(+355) 069 22 22 222",
                    email: "client@website.al",
                    otherInfo: "www.website.al",
                },
                invoice: {
                    label: "Invoice #: ",
                    num: 19,
                    invDate: "Payment Date: 01/01/2021 18:12",
                    invGenDate: "Invoice Date: 02/02/2021 10:17",
                    headerBorder: false,
                    tableBodyBorder: false,
                    header: [
                    {
                        title: "#", 
                        style: { 
                        width: 10 
                        } 
                    }, 
                    { 
                        title: "Title",
                        style: {
                        width: 30
                        } 
                    }, 
                    { 
                        title: "Description",
                        style: {
                        width: 80
                        } 
                    }, 
                    { title: "Price"},
                    { title: "Quantity"},
                    { title: "Unit"},
                    { title: "Total"}
                    ],
                    table: Array.from(Array(10), (item, index)=>([
                        index + 1,
                        "There are many variations ",
                        "Lorem Ipsum is simply dummy text dummy text ",
                        200.5,
                        4.5,
                        "m2",
                        400.5
                    ])),
                    invTotalLabel: "Total:",
                    invTotal: "145,250.50",
                    invCurrency: "ALL",
                    row1: {
                        col1: 'VAT:',
                        col2: '20',
                        col3: '%',
                        style: {
                            fontSize: 10 //optional, default 12
                        }
                    },
                    row2: {
                        col1: 'SubTotal:',
                        col2: '116,199.90',
                        col3: 'ALL',
                        style: {
                            fontSize: 10 //optional, default 12
                        }
                    },
                    invDescLabel: "Invoice Note",
                    invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
                },
                footer: {
                    text: "The invoice is created on a computer and is valid without the signature and stamp.",
                },
                pageEnable: true,
                pageLabel: "Page ",
            }
        }
    },
    methods: {
        getNumberOfPages() {
            // const jsPDF = jsPDFInvoiceTemplate(this.props)
            this.number += 1
        },
        sendEmail(e) {
            try {
                emailjs.send('service_l2bh374','template_yl7r9y7', {
                    order_id: this.order_id,
                    to_name: this.to_name,
                    receiver: this.receiver,
                }, 
                'xOnownoRFQ2QGLw-6'
                );
                alert('užsakymo užklausa išsiųsta')
            } 
            catch(error) {
                alert(error)
            }
        }
    }, 
    watch: {
        // number(newNumber, oldNumber) {
        //     if(newNumber == 5) {
        //         this.sendEmail()
        //     }
        // }
    }

}
</script>
<style>
.generate-pdf {
    background-color: #fff;
    height: 30px;
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
    letter-spacing: 0.01em;
    color: #a85727;
    border: 1px solid #a85727;
    border-radius: 5px;
    text-transform: uppercase;
    padding: 0.25em 0.5em;
}
</style>