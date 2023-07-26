function generatePDF() {
    const invoice = document.getElementById("invoice");
    var opt = {
        margin: [20,20,20,20], // top, right, bottom, left margins in inches
        filename: 'Report.pdf',
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "in", format: "letter", orientation: 'portrait', pagebreak: { mode: 'avoid-all' } }
    };
    html2pdf().from(invoice).set(opt).save();
}
