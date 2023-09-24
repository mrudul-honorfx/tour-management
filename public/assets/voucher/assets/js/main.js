const handleExportPDF = async () => {
  const data = document.getElementById('pdf-content');
  const pageHeight = 295; // Set the desired height of each page in the PDF (A4 height in mm)
  
  // Initialize jsPDF and get its width
  const doc = new jsPDF('p', 'mm');
  const docWidth = doc.internal.pageSize.getWidth();

  let positionY = 0;
  let currentPage = 1;

  const addNewPage = () => {
    doc.addPage();
    positionY = 0;
    currentPage++;
  };

  const renderContent = async (child) => {
    const canvas = await html2canvas(child, { scale: 1 }); // Capture content as a canvas
    const imgData = canvas.toDataURL('image/jpeg', 1.0);
    const imgHeight = (canvas.height * docWidth) / canvas.width;

    if (positionY + imgHeight > pageHeight) {
      addNewPage();
    }

    doc.addImage(imgData, 'JPEG', 0, positionY, docWidth, imgHeight);
    positionY += imgHeight;
  };

  const children = Array.from(data.children);

  for (let i = 0; i < children.length; i++) {
    const child = children[i];

    await renderContent(child);
  }

  doc.save('Download.pdf');
};
