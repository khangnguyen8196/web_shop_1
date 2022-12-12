(function () {
  tinymce.create("tinymce.plugins.detail", {
    init: function (a, b) {
      var d = this,
        c = tinymce.explode(a.settings.content_css);
      d.editor = a;
      tinymce.each(c, function (f, e) {
        c[e] = a.documentBaseURI.toAbsolute(f);
      });
      a.addCommand("mcedetail", function () {
        a.windowManager.open(
          {
            file: a.getParam("plugin_detail_pageurl", b + "/detail.php"),
            width: parseInt(a.getParam("plugin_detail_width", "550")),
            height: parseInt(a.getParam("plugin_detail_height", "600")),
            resizable: "yes",
            scrollbars: "yes",
            popup_css: c
              ? c.join(",")
              : a.baseURI.toAbsolute(
                  "themes/" +
                    a.settings.theme +
                    "/skins/" +
                    a.settings.skin +
                    "/content.css"
                ),
            inline: a.getParam("plugin_detail_inline", 1),
          },
          { base: a.documentBaseURI.getURI() }
        );
      });
      a.addButton("detail", {
        title: "detail.detail_desc",
        cmd: "mcedetail",
      });
    },
    getInfo: function () {
      return {
        longname: "detail",
        author: "Moxiecode Systems AB",
        authorurl: "http://tinymce.moxiecode.com",
        infourl: "http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/detail",
        version: tinymce.majorVersion + "." + tinymce.minorVersion,
      };
    },
  });
  tinymce.PluginManager.add("detail", tinymce.plugins.detail);
})();
