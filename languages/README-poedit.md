# Generating .mo Files with Poedit

The `.po` files in this directory need to be compiled to `.mo` files to be used by WordPress. While we've included pre-compiled `.mo` files, this guide explains how to generate them yourself if you make changes to the translations.

## Installing Poedit

1. Download and install Poedit from [https://poedit.net/](https://poedit.net/)
2. Launch Poedit after installation

## Compiling a .mo File from Existing .po File

1. Open Poedit
2. Click on **File** > **Open**
3. Navigate to the theme's language directory (`wp-content/themes/JTheme/languages`)
4. Select the `.po` file you want to compile (e.g., `fa_IR.po`)
5. The translation editor will open with all the strings
6. Review the translations if needed
7. Click on **File** > **Save**
8. Poedit will automatically generate the corresponding `.mo` file in the same directory

## Creating a New Translation

1. Open Poedit
2. Click on **File** > **New From POT/PO File**
3. Select the template file `jthem.pot`
4. Choose the language for your new translation
5. Enter translations for each string
6. Save the file with the appropriate locale name (e.g., `de_DE.po` for German)
7. Poedit will automatically generate the `.mo` file

## Updating Translations

When the template (`jthem.pot`) changes after adding new strings to the theme:

1. Open your existing `.po` file in Poedit
2. Click on **Catalog** > **Update from POT file**
3. Select the updated `jthem.pot` file
4. Poedit will mark new/changed strings that need translation
5. Add the missing translations
6. Save the file to update the `.mo` file

## Command Line Alternative

If you prefer using the command line, you can use the `msgfmt` utility from the GNU gettext package:

```bash
# Install gettext if not already installed
# For macOS: brew install gettext
# For Ubuntu/Debian: sudo apt-get install gettext

# Compile .mo file from .po file
msgfmt -o fa_IR.mo fa_IR.po
```

This will generate the binary `.mo` file that WordPress uses for translations. 