# Image to Text

A simple PHP script that extracts texts from image stored in a folder. All texts extracted are stored in separate files
in the "texts" folder

## Libraries used

- PyTorch
    - https://pytorch.org/
    - `$ pip install torch torchvision torchaudio --index-url https://download.pytorch.org/whl/cu128`
- EasyOCR
    - https://github.com/JaidedAI/EasyOCR
    - `$ pip install easyocr`

## Command line

`$ easyocr -l en fr -f input_image.jpg --detail=0 > ./output.txt`