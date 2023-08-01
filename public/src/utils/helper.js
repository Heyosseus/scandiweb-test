export const getFormattedDimensions = (dimensionsString) => {
  try {
    if (!dimensionsString) {
      return ''
    }
    const dimensions = JSON.parse(dimensionsString)
    return `${dimensions.width}x${dimensions.height}x${dimensions.length}`
  } catch (error) {
    console.error('Error parsing dimensions:', error)
    return ''
  }
}
