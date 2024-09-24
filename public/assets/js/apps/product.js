FilePond.registerPlugin(FilePondPluginImagePreview);
FilePond.registerPlugin(FilePondPluginFileValidateType);
FilePond.registerPlugin(FilePondPluginFileValidateSize);

const inputPackage = document.querySelector("#productPackage");
if (inputPackage && productPackage.value.length > 0) {
  const package = JSON.parse(productPackage.value);
  const checkBox = document.querySelectorAll(`[name="package_type"]`);

  if (package.package_type == 1) {
    checkBox[0].checked = true;

    document.querySelector(`[name="minimum_qty_1"]`).value = package.minimum_qty;
    document.querySelector(`[name="package_price_percent_1"]`).value = package.value;
  } else if (package.package_type == 2) {
    checkBox[1].checked = true;

    document.querySelector(`[name="minimum_qty_2"]`).value = package.minimum_qty;
    document.querySelector(`[name="package_price_percent_2"]`).value = package.value;
  } else if (package.package_type == 3) {
    checkBox[2].checked = true;

    document.querySelector(`[name="minimum_qty_3"]`).value = package.minimum_qty;
    document.querySelector(`[name="package_price_percent_3"]`).value = package.value;
  }
}

// Get a reference to the file input element
const inputElement = document.querySelector('input[type="file"]');

const listImages = document.querySelectorAll(".list_images");

const sources = [];
if (listImages) {
  for (const image of listImages) {
    sources.push({
      source: image.value,
      options: {
        type: "local",
      },
    });
  }
}

// Create a FilePond instance
const pond = FilePond.create(inputElement, {
  allowImagePreview: true,
  imagePreviewHeight: 120,
  allowMultiple: true,
  acceptedFileTypes: ["image/*"], // Accept only image types
  labelFileTypeNotAllowed: "Only image files are allowed.",
  fileValidateTypeLabelExpectedTypes: "Expected image files only.",
  maxFiles: 7,
  files: sources,
  server: {
    url: CORE.baseUrl,
    load: {
      url: "/loadimage?id=",
      method: "GET",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
    },
    process: {
      url: "/uploadimage",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
    },
    revert: {
      url: "/revertupload",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
      body: JSON.stringify({
        test: "asd",
      }),
    },
  },
});

// Get a reference to the file input element
const inputVideo = document.querySelector(".video-input");

const listVideo = document.querySelector(".list_video");
const videoSource = [];

if (listVideo) {
  videoSource.push({
    source: listVideo.value,
    options: {
      type: "local",
    },
  });
}

console.log(videoSource);

// Create a FilePond instance
const pondVideo = FilePond.create(inputVideo, {
  allowImagePreview: true,
  imagePreviewHeight: 120,
  acceptedFileTypes: ["video/mp4"], // Accept only MP4
  fileValidateTypeLabelExpectedTypesMap: {
    "video/mp4": ".mp4", // Label for error message if file type is wrong
  },
  maxFileSize: "35MB",
  files: videoSource,
  server: {
    url: CORE.baseUrl,
    load: {
      url: "/loadimage?video=true&id=",
      method: "GET",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
    },
    process: {
      url: "/uploadimage",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
    },
    revert: {
      url: "/revertupload",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
      body: JSON.stringify({
        test: "asd",
      }),
    },
  },
});

const productDescription = document.getElementById("product_description");
const porductDescriptionWord = document.querySelector(
  ".product_description_word"
);
const maxChars = 3000;

productDescription.addEventListener("keyup", function (e) {
  const textLength = e.target.value.length;

  // Update character count display
  porductDescriptionWord.textContent = `${textLength}/${maxChars}`;

  // Prevent typing more than 3000 characters
  if (textLength > maxChars) {
    productDescription.value = productDescription.value.substring(0, maxChars);
    porductDescriptionWord.textContent = `${maxChars}/${maxChars}`; // Correct display if cut off
  }
});
