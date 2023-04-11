<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Employee List</title>
        <link rel="stylesheet" type="text/css" href="employee.css"/>
      </head>
      <body>
        <xsl:apply-templates/>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="employee">
    <div class="employee">
      <h2><xsl:value-of select="name"/></h2>
      <p><xsl:value-of select="email"/></p>
      <p><xsl:value-of select="phone"/></p>
      <p><xsl:value-of select="address"/></p>
    </div>
  </xsl:template>
</xsl:stylesheet>
