window.addEventListener('DOMContentLoaded', event => {
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
});

const toolbarConf = ['Heading', 'Bold', 'Italic', 'Underline', 'Link', 'Alignment', 'Indent', 'BlockQuote', 'FontFamily', 'FontSize', 'FontColor', 'Strikethrough', 'Subscript', 'Superscript', 'HorizontalLine', 'CodeBlock']