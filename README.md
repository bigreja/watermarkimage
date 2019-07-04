# watermarkimage

Ads the ability to watermark any image file on Silverstripe

Ads Tab on Site settings to set watermark image, position and alpha.

Just add this on your template and it will watermark the image base on settings you made on site settings

```
<img src="$imgFieldName.Watermark.Link" />
```

You can use it with any other image extension, like Jonom Focuspoint just use chains

```
<img src="$imgFieldName.FocusFillMax(400,400).Watermark.Link" />
```
